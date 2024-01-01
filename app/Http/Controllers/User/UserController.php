<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\UserImage;
use Illuminate\Support\Facades\Hash;

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
            return redirect()->route('home')->with('login','Logined successfully!');
        }
        else 
        {
            return redirect()->route('user.login')
            ->withErrors(['login' => 'Invalid credentials'])
            ->withInput($req->only('email'));
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

    public function registerNew(Request $req)
    {
        $req->validate([
            'name'=> 'required|min:3|regex:/^[a-zA-Z\s]+$/',
            'email'=> 'required|email|unique:users,email',
            'phone'=> 'required|size:10|unique:users,phone',
            'gender' => 'required|in:male,female,other',
            'password'=> 'required|confirmed',
            'img'=> 'required',
        ],
        [
            'gender.required' =>'Please select gender',
            'gender.in' => 'Please select gender',
            'img.required' => 'Please upload profile image'
        ]);

        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->gender = $req->gender;
        $user->password = Hash::make($req->password);

        $user_image = new UserImage;

        if($req->hasFile('img'))
        {
            $imageName  = $req->img->getClientOriginalName();
            $req->file('img')->move(public_path().'/img/users/', $imageName);
            $user_image->image = $imageName;
        }

        $user->save();
        $res = $user->userimage()->save($user_image);

            return redirect()->route('user.login')->with('register','Registration successfully!');
           // return redirect()->route('home')->with('login','Logined successfully!');
        
        
    }

    public function account()
    {
        return view('user.account');
    }
}
