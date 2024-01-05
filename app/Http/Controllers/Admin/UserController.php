<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::all();
        $roles = Role::all();


        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $roles = Role::all();

        return view('admin.users.form', compact('users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            //'name' => ['required'],
            'email' => ['required', 'lowercase', 'email', 'unique:' . User::class],
            'nom' => ['required'],
            'prenom' => ['required'],
            'genre' => ['required'],
            'site' => ['max:255'],
            'departement' => ['max:255'],
            'fonction' => ['max:255'],
            'is_active' => ['required'],
            'password' => ['required', 'min:3']
        ]);

        $user = User::create([
            //'name' => $request->name,
            'email' => $request->email,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'genre' => $request->genre,
            'site' => $request->site,
            'departement' => $request->departement,
            'fonction' => $request->fonction,
            'is_active' => $request->is_active,
            'password' => Hash::make($request->password)
        ]);

        $user->roles()->attach($request->input('roles', []));

        event(new Registered($user));

        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->with('roles')->get();

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.form', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'string',
            'email' => ['required', 'string', 'email', 'unique:users,email,' . $user->id],
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'genre' => 'required',
            'site' => 'string',
            'departement' => 'string',
            'fonction' => 'string',
            'is_active' => ''
        ]);

        $user->update($data);

        if (!empty($request->password)) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
        }



        $user->roles()->sync($request->input('roles', []));

        $user->save();

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
