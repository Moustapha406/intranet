<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function __construct()
    // {
    //     $this->middleware('permission:permi-read|permi-create|permi-edit|permi-delete', ['only' => ['index', 'store']]);
    //     $this->middleware('permission:permi-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:permi-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:permi-delete', ['only' => ['destroy']]);
    // }
    public function index()
    {
        $permissions = Permission::orderBy("id", "desc")->paginate(10);

        return view("admin.permission.index", compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view("admin.permission.form", compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            "name" => ["required"]
        ]);

        $per = Permission::create($request->only('name'));

        // $permission=Permission::create(['name'=>$request->name,]);

        $per->save();

        return redirect()->route('permissions.index')->with('success', 'La permission est bien ajouté');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::findOrFail($id);
        $roles = Role::all();

        return view("admin.permission.form", compact("permission", 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {


        $data = $request->validate([
            'name' => ['required', 'string'],
        ]);



        $permission = Permission::findOrfail($id);
        $permission->update($data);
        $permission->save();

        return redirect()->route('permissions.index')->with('success', 'La permission  a été bien modifier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();

        return redirect()->route('permissions.index')->with('success', "La permission a été supprimé avec succées");
    }
}