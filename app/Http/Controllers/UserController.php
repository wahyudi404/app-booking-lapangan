<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('pages.admin.user', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => 'required',
        ]);

        try {
            $user = new User();
            $user->fullname = $request->fullname;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = $request->role_id;
            $user->save();

            return back()->with('success', 'User created successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'role_id' => 'required',
        ]);

        if ($request->password) {
            $request->validate([
                'password' => ['string', 'min:8', 'confirmed'],
            ]);
        }

        try {
            $user = User::find($id);
            $user->fullname = $request->fullname;
            $user->username = $request->username;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->role_id = $request->role_id;
            $user->save();

            return back()->with('success', 'User updated successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);
            $user->delete();

            return back()->with('success', 'User deleted successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
