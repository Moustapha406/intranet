<?php

namespace App\Http\Controllers\Profile;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth()->user();

        return view('profile.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
    }


    public function updatePassword(Request $request)
    {

        $data = $request->validate([
            'password' => ['required', 'confirmed']
        ]);

        $request->user()->update([
            'password' => Hash::make($data['password'])
        ]);

        return redirect()->route('profile.index')->with('success', 'Le mot de passe est bien modifier');
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
    public function edit(Request $request): View
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password']
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}