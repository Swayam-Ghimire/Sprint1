<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Api\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $deviceName = $request->header('User-Agent', 'Unknown Device');
        $user = User::create($data);
        $role = Role::where('name', 'admin')->first();
        $user->roles()->attach($role);

        return response()->json([
            'message' => 'Registered',
            'access_token' => $user->createToken($deviceName)->plainTextToken,
            'user' => $user,
            'role' => $user->roles->pluck('name'),
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $deviceName = $request->header('User-Agent', 'Unknown Device');
        $user = User::where('email', $data['email'])->first();
        if (! $user || ! (Hash::check($data['password'], $user->password))) {
            return response()->json([
                'message' => 'The entered credentials are incorrect',
            ], 401);
        }

        return response()->json([
            'message' => 'Logged In',
            'access_token' => $user->createToken($deviceName)->plainTextToken,
            'user' => $user,
            'role' => $user->roles->pluck('name'),
        ], 200);

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }
}
