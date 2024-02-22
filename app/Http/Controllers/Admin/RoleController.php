<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function  __construct()
    {
        $this->middleware('permission:role-read|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(10);

        //dd($roles);

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::get();

        return view('admin.roles.form', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'unique:roles,name'],
            //'permissions' => ['required']
        ]);

        $role = Role::create(['name' => $request->name,]);

        $permission = Permission::wherein('id', $request->input('permission', []))->get();

        $role->syncPermissions($request->input('permission'));

        $role->save();


        return redirect()->route('roles.index')->with('success', 'le role est bien créer');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $role = Role::findById($id);

        $rolePermissions = Permission::join('role_has_permissions', "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $role = Role::findById($id);
        //$permission=Permission::get();

        // $rolePermission=DB::table('role_has_permissions')->where('role_has_permissions.role_id',$id)
        //                 ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        //                 ->all();

        $permissions = Permission::all();


        return view('admin.roles.form', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'name' => ['required', 'string'],
            'permission' => []
        ]);

        $role = Role::find($id);

        $role->name = $data['name'];

        $role->syncPermissions($request->input('permission'));

        //$role->users()->sync($request->input('users', []));

        $role->save();

        return redirect()->route('roles.index')->with("success", "La mise a jour est bien fait");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id)->delete();
        return redirect()->route('roles.index')->with('success', "Le role est bien supprimé");
    }
}