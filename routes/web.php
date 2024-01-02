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
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserController;


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

Route::get('/',[HomeController::class,'index'])->name('home')->middleware('web');

Route::controller(AuthController::class)->group(function()
{
    Route::prefix('admin')->group(function()
    {
        Route::get('/login', 'adminlogin')->name('admin.login');
        Route::post('/auth', 'adminauth')->name('admin.auth');
        
    });
});

//================== ADMIN CHECK MIDDLEWARE ===============//
Route::middleware(['web','adminCheck'])->group(function()
{
    Route::view('/dashboard','admin.dashboard')->name('dashboard');
    Route::get('/dashboard/status',[DashboardController::class, 'showStatus'])->name('status');


    //================= ADMIN ROUTES =====================//
    Route::controller(AuthController::class)->group(function()
    {
        Route::prefix('admin')->group(function()
        {
            Route::get('/profile', 'adminProfile')->name('admin.profile');
            Route::get('/admin/logout','logout')->name('admin.logout');
        });
    });

    Route::get('/customer',[CustomerController::class, 'getCustomer'])->name('customer');
    //Route::get('/customer/list',[CustomerController::class,'showCustomer'])->name('customer.list');

    //================= CATEGORY CONTROLLER =======================//
    Route::controller(CategoryController::class)->group(function()
    {
        Route::prefix('category')->group(function()
        {
            Route::get('/','show')->name('category');
            Route::get('/new', 'new')->name('category.add');
            Route::post('/add', 'add')->name('category.add.new');
            Route::get('/edit/{id}', 'edit')->name('category.edit');
            Route::post('/update', 'update')->name('category.update');
            Route::delete('/delete/{id}', 'delete')->name('category.delete');
        });
        
    });


    //===================== SUB-CATEGORY =========================//

    Route::controller(SubCatController::class)->group(function()
    {
        Route::prefix('subcat')->group(function()
        {
            Route::get('/list','show')->name('subcat.show');
            Route::get('/add','add')->name('subcategory.add');
            Route::post('/new','save')->name('subcategory.new');
            Route::get('/edit/{id}','edit')->name('subcategory.edit');
            Route::post('/update','update')->name('subcategory.update');
            Route::delete('/delete/{id}','delete')->name('subcategory.delete');
        });
        
    });


    //======================= BRAND ROUTES ======================//

    Route::controller(BrandController::class)->group(function()
    {
        Route::prefix('brand')->group(function()
        {
            Route::get('/add','new')->name('brand.add');
            Route::post('/add','add')->name('brand.add.new');
            Route::get('/show','show')->name('brand.show');
            Route::get('/edit/{id}','edit')->name('brand.edit');
            Route::post('/update','update')->name('brand.update');
            Route::delete('/delete/{id}','delete')->name('brand.delete');
        });
    });


    //========================= PRODUCT ROUTE ====================//

    Route::controller(ProductController::class)->group(function()
    {
        Route::prefix('product')->group(function()
        {
            Route::get('/list','list')->name('product.list');
            Route::get('/add','add')->name('product.add');
            Route::post('/add','create')->name('product.create');
            Route::delete('/delete/{id}','delete')->name('product.delete');
            Route::get('/edit/{id}','edit')->name('product.edit');
            Route::post('/update','update')->name('product.update');
        });

        Route::get('/subcategory/detail/{id}','getSubCat')->name('subcat.details');
        
    });


    //========================== ORDERS ROUTES ===================//
    Route::get('/order',[OrderController::class, 'show'])->name('order');
    Route::get('/order/details',[OrderController::class, 'details'])->name('order.details');

    Route::view('/shipping','admin.shipping')->name('shipping');

    Route::view('/password','admin.password.changepassword')->name('admin.password');

});
//================= END ADMIN ROUTES ================//



//================= USER ROUTES ====================//

Route::get('/user/login',[UserController::class, 'login'])->name('user.login');
Route::post('/user/login',[UserController::class, 'auth'])->name('user.auth');
Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');
Route::get('/user/register',[UserController::class, 'register'])->name('user.register');
Route::post('/user/register',[UserController::class, 'registerNew'])->name('user.register.new');
Route::get('/user/account',[UserController::class, 'account'])->name('user.account');
Route::get('/product/{id}',[HomeController::class, 'product'])->name('product');


Route::middleware(['userCheck','web'])->group(function()
{
    Route::get('/cart/show',[HomeController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/add',[HomeController::class, 'cart'])->name('cart.add');
    Route::post('/cart/update',[HomeController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/delete/{id}',[HomeController::class, 'deleteCart'])->name('cart.delete');
    Route::get('/checkout',[HomeController::class, 'checkout'])->name('checkout');

    Route::get('/wishlist/show',[HomeController::class, 'showWishlist'])->name('wishlist.show');
    Route::post('/wishlist/add',[HomeController::class, 'addWishlist'])->name('wishlist.add');
    Route::post('/wishlist/delete',[HomeController::class,'deleteWishlist'])->name('wishlist.delete');
});
//================= END USER ROUTES ===============//

route::fallback(function()
{
    return "<h1>Page Not Found</h1>";
});