<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //============== LOGIN ===========//
    public function login()
    {
        return view('user.login');
    }

    //============= LOGIN AUTH =========//
    public function auth(Request $req)
    {
        $req->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $credentials = $req->only('email', 'password');

        if (auth()->attempt($credentials)) 
        {
            return redirect()->route('home')->with('success','Logined successfully!');
        }
    }

    //============= USER LOGOUT =============//
    public function logout()
    {
        if(auth()->user())
        {
            auth()->logout();
            return redirect()->route('user.login');
        }
    }

    //============== REGISTER ==========//
    public function register()
    {
        return view('user.register');
    }

    public function account()
    {
        return view('user.account');
    }
}
