<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        // Authenticate user (for example, using email and password)
        if ($token = JWTAuth::attempt($credentials)) {
            // User authenticated, generate JWT token
            return response()->json(['token' => $token], 200);
        }

        // Authentication failed
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function register(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6|max:255',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function changePassword(Request $request)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
    
        // Validate incoming request data
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6|max:255',
        ]);
    
        // Retrieve the authenticated user
        $user = Auth::user();
    
        // Verify if the old password matches the user's current password
        if (!Hash::check($request->input('old_password'), $user->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 400);
        }
    
        // Update the user's password
        $user->password = Hash::make($request->input('new_password'));
        
        $user->save();
    
        return response()->json(['message' => 'Password changed successfully'], 200);
    }
    

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
