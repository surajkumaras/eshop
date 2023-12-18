<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show()
    {
        return view('admin.orders.order');
    }

    public function details()
    {
        return view('admin.orders.orderDetail');
    }
}
