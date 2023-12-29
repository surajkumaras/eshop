<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ResponseJson;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ResponseJson;

    public function adminlogin()
    {
        // return Auth::user();
        return view('admin.login');
    }

    public function logout()
    {
        if(auth()->user())
        {
            auth()->logout();
            return redirect()->route('admin.login');
        }
    }

    public function adminauth(Request $req)
    {
        $req->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $credentials = $req->only('email', 'password');

        if (auth()->attempt($credentials)) 
        {
            return redirect()->route('dashboard')->with('success','Logined successfully!');
        }
    }

    //============== ADMIN PROFILE ============//
    public function adminProfile()
    {
        $data = User::find(1);

        return $this->successResponse($data);
    }
}
