<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Registrasi
    public function register(Request $request)
    {
        // Validasi input

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json(['user' => $user, 'message' => 'User registered successfully']);
    }

    // Login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->plainTextToken;
    
            return response()->json(['user' => $user, 'access_token' => $token]);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    // Logout
    public function logout()
    {
        $user = Auth::user();

        if ($user) {
            $user->tokens()->delete(); // Revoke all user tokens

            return response()->json(['message' => 'Successfully logged out']);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    // Read (Get All Users)
    public function index()
    {
        $users = User::all();

        return response()->json(['users' => $users]);
    }

    // Read (Get User by ID)
    public function show($id)
    {
        $user = User::find($id);

        return response()->json(['user' => $user]);
    }

    // Create
    public function store(Request $request)
    {
        // Validasi input

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json(['user' => $user, 'message' => 'User created successfully']);
    }

    // Update
    public function update(Request $request, $id)
    {
        // Validasi input

        $user = User::find($id);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json(['user' => $user, 'message' => 'User updated successfully']);
    }

    // Delete
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}

