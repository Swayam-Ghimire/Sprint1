<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
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

        if (! Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Invalid credentials',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('posts.index')->with('message', 'Logged In successfully');

    }

    public function register(RegisterRequest $request)
    {
        //
        $data = $request->validated();
        $user = User::create($data);
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('posts.index')->with('message', 'Registered successfully');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to('/login')->with('message', 'Logged out successfully');
    }
}
