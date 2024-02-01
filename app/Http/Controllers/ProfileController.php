<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $roles = Role::all();

        return view('profile.index', [
            'user' => $user,
            'roles' => $roles
        ]);
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        if ($request->input('roles')){
            $user->assignRole($request->input('roles'));
        }


        return redirect()->route('profile.index')->with('success', 'Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updatePassword(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'password' => 'required|confirmed'
        ]);

        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Password updated successfully');
    }
}
