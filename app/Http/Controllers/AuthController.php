<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Jobs\LogUserRegistered;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        //
        $credentials = $request->validated();
        // dd(Auth::attempt($credentials)); // true if right cred
        if (! Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Invalid credentials',
            ]);
        }
        // dd($request->session()->regenerate()); true
        $request->session()->regenerate();

        return redirect()->route('posts.index')->with('message', 'Logged In successfully');

    }

    public function register(RegisterRequest $request)
    {
        //
        $data = $request->validated();
        $user = User::create($data);
        if($request->hasFile('profile_picture')){
            $path = $request->file('profile_picture')->store('users', 'public');
            $user->image()->create(['path'=>$path]);
        }

        // dd(Auth::login($user)); null
        $role = Role::where('name', 'member')->first();
        $user->roles()->attach($role);
        // dd($user->roles());
        Auth::login($user);
        $request->session()->regenerate();
        LogUserRegistered::dispatch($user);

        return redirect()->route('posts.index')->with('message', 'Registered successfully');

    }

    public function logout(Request $request)
    {
        // dd(Auth::logout());
        // dd($request->session()->invalidate());
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to('/login')->with('message', 'Logged out successfully');
    }
}
