<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Datatables;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => "User registered successfully",
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user_admin' => $user->is_admin,
            'user_id' => $user->id,
            'message' => "User logged in successfully",
        ]);
    }

    public function profile(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'User successfully signed out']);
    }

    //Pour le back 
    public function editUser(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->update($request->all());
        return response()->json(['success' => 'User saved successfully !']);
    }

    public function getUser($id)
    {
        return User::findOrFail($id);
    }

    public function getallUser()
    {
        return User::all();
    }

    public function deleteUsers($id)
    {
        User::findOrFail($id)->delete();
        return response(['message' => 'Deleted Successfully'], 200);
    }
}
