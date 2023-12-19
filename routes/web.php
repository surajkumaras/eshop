<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCatController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;



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
Route::get('/category/edit/{id}',[CategoryController::class, 'edit'])->name('category.edit');
Route::post('category/update',[CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/delete/{id}',[CategoryController::class, 'delete'])->name('category.delete');


//Route::view('/subcat','admin.subcategory.sub-category')->name('subcategory');
Route::get('/subcat/list', [SubCatController::class, 'show'])->name('subcat.show');
Route::get('/subcat/add',[SubCatController::class, 'add'])->name('subcategory.add');
Route::post('/subcat/new',[SubCatController::class, 'save'])->name('subcategory.new');
Route::get('/subcat/edit/{id}',[SubCatController::class, 'edit'])->name('subcategory.edit');
Route::post('/subcat/update',[SubCatController::class, 'update'])->name('subcategory.update');
Route::delete('/subcat/delete/{id}',[SubCatController::class, 'delete'])->name('subcategory.delete');

//Route::view('/brand','admin.brand.brand')->name('brand');
Route::view('/brand/add','admin.brand.addbrand')->name('brand.add');
Route::post('/brand/add',[BrandController::class, 'add'])->name('brand.add.new');
Route::get('/brand/show',[BrandController::class, 'show'])->name('brand.show');
Route::get('/brand/edit/{id}',[BrandController::class,'edit'])->name('brand.edit');
Route::post('/brand/update',[BrandController::class, 'update'])->name('brand.update');
Route::delete('/brand/delete/{id}',[BrandController::class, 'delete'])->name('brand.delete');


Route::get('/product/list',[ProductController::class, 'list'])->name('product.list');
Route::get('/product/add',[ProductController::class,'add'])->name('product.add');
Route::post('/product/add',[ProductController::class,'create'])->name('product.create');
Route::get('/subcategory/detail/{id}',[ProductController::class, 'getSubCat'])->name('subcat.details');

Route::get('/order',[OrderController::class, 'show'])->name('order');
Route::get('/order/details',[OrderController::class, 'details'])->name('order.details');

Route::view('/shipping','admin.shipping')->name('shipping');

Route::view('/password','admin.password.changepassword')->name('admin.password');
//================= END ADMIN ROUTES ================//



//================= USER ROUTES ====================//

//================= END USER ROUTES ===============//