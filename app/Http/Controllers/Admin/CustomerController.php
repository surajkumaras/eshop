<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Traits\ResponseJson;

class CustomerController extends Controller
{
    use ResponseJson;

    public function getCustomer()
    {
        $data = User::with('address')->where('role','0')->with('userimage')->get();
        // return $data;
        return view('admin.customer.customer',['data' => $data]);
    }

    public function showCustomer()
    {
        $data = User::with('address')->where('role','0')->get();

        return $this->successResponse($data);
    }

}
