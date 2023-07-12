<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');   
    }

    public function singin(Request $request)
    {
        if(!Auth::attempt($request->only(['email','password'])))
        {
            return redirect()->back()->withErrors(['Usuario ou senha inválido']);
        }

        return to_route('series.index');
    }

    public function destroy()
    {
        Auth::logout();
        return to_route('login');
    }
}