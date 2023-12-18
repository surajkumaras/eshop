<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCatController;
use App\Http\Controllers\Admin\OrderController;



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
//Route::get('/customer/list',[CustomerController::class,'showCustomer'])->name('customer.list');

Route::get('/category',[CategoryController::class, 'show'])->name('category');
Route::view('/category/add','admin.category.addcategory')->name('category.add');
Route::post('/category/add',[CategoryController::class, 'add'])->name('category.add.new');


//Route::view('/subcat','admin.subcategory.sub-category')->name('subcategory');
Route::get('/subcat/list', [SubCatController::class, 'show'])->name('subcat.show');
Route::get('/subcat/add',[SubCatController::class, 'add'])->name('subcategory.add');
Route::post('/subcat/new',[SubCatController::class, 'save'])->name('subcategory.new');

//Route::view('/brand','admin.brand.brand')->name('brand');
Route::view('/brand/add','admin.brand.addbrand')->name('brand.add');
Route::post('/brand/add',[BrandController::class, 'add'])->name('brand.add.new');
Route::get('/brand/show',[BrandController::class, 'show'])->name('brand.show');

Route::view('/product','admin.product.product')->name('product');
Route::view('/product/add','admin.product.addProduct')->name('product.add');

Route::get('/order',[OrderController::class, 'show'])->name('order');
Route::get('/order/details',[OrderController::class, 'details'])->name('order.details');

Route::view('/shipping','admin.shipping')->name('shipping');

Route::view('/password','admin.password.changepassword')->name('admin.password');
//================= END ADMIN ROUTES ================//



//================= USER ROUTES ====================//

//================= END USER ROUTES ===============//