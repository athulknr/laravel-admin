<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class DashboardController extends Controller
{
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone_no' => 'nullable|string|max:15',
        ]);

        // Update the user
        $user->update($validated);

        return redirect()->route('dashboard')->with('success', 'User updated successfully');
    }
    public function search(Request $request)
    {
    $query = $request->input('query');

    $users = User::where('name', 'LIKE', "%{$query}%")
        ->orWhere('email', 'LIKE', "%{$query}%")
        ->orWhere('phone_no', 'LIKE', "%{$query}%")
        ->orWhere('role', 'LIKE', "%{$query}%")
        ->get();

    return response()->json($users);
    }


    public function index(Request $request)
    {
        $query = User::where('id', '>', 1);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone_no', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('id', 'asc')->paginate(6);

        return view('dashboard', compact('users'));
    }

    public function edit($id)
    {
    // Fetch the user by id
    $user = User::findOrFail($id);

    // Return the view and pass the user data
    return view('user.edit', compact('user'));
    }

    // Method to add a new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_no' => 'nullable|string|max:15',
            'role' => 'required|in:admin,user',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $user->role = $request->role;
        $user->password = Hash::make('password'); // or a password input field in the form
        $user->save();

        return redirect()->route('dashboard')->with('success', 'User added successfully');
    }



    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('dashboard')->with('success', 'User deleted successfully');
    }



}
