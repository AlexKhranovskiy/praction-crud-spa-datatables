<?php

namespace App\Http\Controllers\Api;


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
}
