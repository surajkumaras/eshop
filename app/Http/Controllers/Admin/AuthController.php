<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ResponseJson;
use App\Models\User;

class AuthController extends Controller
{
    use ResponseJson;

    public function adminlogin()
    {
        return view('admin.login');
    }

    public function adminauth(Request $req)
    {
        $req->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
    }

    //============== ADMIN PROFILE============//
    public function adminProfile()
    {
        $data = User::find(1);

        return $this->successResponse($data);
    }
}
