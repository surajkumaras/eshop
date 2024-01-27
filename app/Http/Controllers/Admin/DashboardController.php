<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Traits\ResponseJson;

class DashboardController extends Controller
{
    use ResponseJson;

    public function showStatus()
    {
        $users = User::where('role','0')->count();
        $orders = Order::count();
        return response()->json(['status'=>'success','users' => $users, 'orders' => $orders]);
    }
}
