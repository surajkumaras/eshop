<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;


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
Route::post('/admin/auth',[AuthController::class, 'adminauth'])->name('admin.auth');

Route::get('/admin/profile',[AuthController::class, 'adminProfile'])->name('admin.profile');

Route::view('/dashboard','admin.dashboard')->name('dashboard');
Route::get('/dashboard/status',[DashboardController::class, 'showStatus'])->name('status');

Route::get('/customer',[CustomerController::class, 'getCustomer'])->name('customer');
Route::get('/customer/list',[CustomerController::class,'showCustomer'])->name('customer.list');

Route::get('/category',function()
{
    return view('admin.category');
})->name('category');

Route::get('/subcat', function()
{
    return view('admin.sub-category');
})->name('subcategory');

Route::get('/brand',function()
{
    return view('admin.brand');
})->name('brand');

Route::get('/product',function()
{
    return view('admin.product');
})->name('product');

Route::get('/order',function()
{
    return view('admin.order');
})->name('order');

//================= END ADMIN ROUTES ================//



//================= USER ROUTES ====================//

//================= END USER ROUTES ===============//