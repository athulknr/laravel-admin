<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{


    public function edit($id)
    {
    // Fetch the user by id
    $user = User::findOrFail($id);

    // Return the view and pass the user data
    return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
   {
    $user = User::findOrFail($id);
    $user->update($request->only('name', 'email', 'phone_no', 'role'));

    return redirect()->route('dashboard')->with('success', 'User updated successfully!');
   }


    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('dashboard')->with('success', 'User deleted successfully');
    }
}

