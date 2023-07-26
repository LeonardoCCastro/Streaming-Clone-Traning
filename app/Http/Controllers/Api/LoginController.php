<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function singin(Request $request)
    {
        $credentials = $request->only(['email','password']);
        if(Auth::attempt($credentials) === false)
        {
            return response()->json('Unauthorized',401);
        }
        $user = Auth::user();
        $token = $user->createToken('token');

        return response()->json($token->plainTextToken);
    }
}