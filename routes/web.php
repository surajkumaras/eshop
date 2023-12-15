<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



//================= ADMIN ROUTES =====================//
Route::get('/admin/login',[AuthController::class, 'adminlogin'])->name('admin.login');

Route::view('/dashboard','admin.dashboard');

//================= END ADMIN ROUTES ================//



//================= USER ROUTES ====================//

//================= END USER ROUTES ===============//