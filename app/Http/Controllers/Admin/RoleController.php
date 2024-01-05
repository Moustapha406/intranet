<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $roles = Role::all();

        return view('admin.roles.form', compact('users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'unique:roles,code'],
            'libelle' => ['required']
        ]);

        $role = Role::create([
            'code' => $request->code,
            'libelle' => $request->libelle
        ]);

        $role->save();


        return redirect(route('roles.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $role->with('users')->get();

        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
        $role->with('users')->get();

        $users = User::all();

        return view('admin.roles.form', compact('role', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {



        $data = $request->validate([
            'code' => ['required', 'string'],
            'libelle' => ['required', 'string']
        ]);



        $role->update($data);

        $role->users()->sync($request->input('users', []));

        $role->save();

        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
