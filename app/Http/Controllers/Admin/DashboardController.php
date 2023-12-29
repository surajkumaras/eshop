<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ResponseJson;

class DashboardController extends Controller
{
    use ResponseJson;

    public function showStatus()
    {
        $data = User::where('role','0')->count();
        return $this->successResponse($data);
    }
}
