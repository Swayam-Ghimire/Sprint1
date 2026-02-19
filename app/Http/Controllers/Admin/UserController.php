<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);

        return view('admin.users.user', compact('users'));
    }

    public function editRole(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.user')->with('message', 'User roles updated successfully!');
    }

    public function delete(User $user)
    {
        $user->posts()->delete();
        DB::table('sessions')->where('user_id', $user->id)->delete();
        $user->delete();
        return redirect()->route('admin.user')->with('message', 'User Deleted!!!');
    }
}
