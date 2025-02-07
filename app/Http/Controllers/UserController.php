<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(10);
        return view('dashboard', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_no' => 'required|numeric',
            'role' => 'required|string',
            'password' => 'required|min:6',
            'description' => 'nullable|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard')->with('success', 'User added successfully!');
    }


    // Delete a user
    public function destroy($id)
    {
    $user = User::find($id);

    if ($user) {
        $user->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 404);
    }


    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('users.edit', compact('user'));
}


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone_no' => 'nullable|string|max:20',
            'role' => 'required|in:admin,user',
        ]);

        // Update user details
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'role' => $request->role,
        ]);

        return redirect()->route('dashboard')->with('success', 'User updated successfully');
    }





}
