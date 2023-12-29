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
