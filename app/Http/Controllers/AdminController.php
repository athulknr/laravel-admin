<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class AdminController extends Controller
{
    public function index()
    {
        dd(34);
        $data['getrecord'] = User::getRecord();

        // $user=
        return view('admin.dashboard');
    }

    public function admin_users(Request $request)
    {
        $users = User::all();
        return view('admin.users.list', compact('users'));
    }

    public function manageUsers()
    {
         // Get users with pagination (10 users per page)
         $users = DB::table('users')->simplePaginate(10);


         // Return a view with the users
         return view('users.index', compact('users'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

}
