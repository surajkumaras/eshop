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
        return view('admin.customer');
    }

    public function showCustomer()
    {
        $data = User::with('address')->where('role','0')->get();

        return $this->successResponse($data);
    }

}
