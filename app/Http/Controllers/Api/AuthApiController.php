<?php

namespace App\Http\Controllers\Api;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

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

    public function logout()
    {
        Cookie::queue(Cookie::forget('XSRF-TOKEN'));
        session()->invalidate();
        return response()->json(
            [
                'message' => 'Successfully logged out',
            ]
        );
    }
}
