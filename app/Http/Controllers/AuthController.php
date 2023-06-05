<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Illuminate\Http\Client\requestsReusableClient;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        if(Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ]
        )) {
            $user = Auth::user();
            //$token = $user->createToken($request->token_name);
//            $result =
//                [
//                    'message' => 'User ' . $user->name . ' successfully logged in.',
//                    'bearer_token' => $token->plainTextToken
//                ];
            //return response()->json($result);
            return redirect()->route('categories');
        } else {
            redirect()->route('user.login.form-show');
//            $result =
//                [
//                    'message' => 'Wrong login or password, or wrong login and password.'
//                ];
            //return response()->json($result, 400);
        }
    }
}
