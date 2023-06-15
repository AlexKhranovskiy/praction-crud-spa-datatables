<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthApiController
{
    public function login()
    {
        if (!Auth::attempt(request()->only('email', 'password'))) {
            return response()->json(['massage' => 'Login failed']);
        }
        return response()->json(
            [
                'message' => 'Login successful',
            ]
        );
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerate();
        return response()->json(
            [
                'message' => 'Successfully logged out',
            ]
        );
    }
}
