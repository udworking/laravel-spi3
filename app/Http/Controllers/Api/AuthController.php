<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // トークン生成
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json(['message' => 'Login successful', 'token' => $token]);
        }
        
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}