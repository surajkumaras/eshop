<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\SubCategory;

class HomeController extends Controller
{
    //=============== VIEW HOME WITH PRODUCTS =================//
    public function index()
    {
        $products = Product::with('productImage')
        ->where('status','1')
        ->orderBy('id','DESC')
        ->get();
        return view('user.home',['products'=>$products]);
    }

    //================ VIEW SPECIFIC PRODUCT DETAILS ============//
    public function product($id)
    {
        $data = Product::find($id);
        $pic = ProductImage::where('product_id',$id)->get();
        
        $relativProduct = Product::with('productImage')
                        ->where('sub_cat_id',$data->sub_cat_id)
                        ->get();
                        
        return view('user.product',['product'=>$data,'productImage'=>$pic,'relativProduct'=>$relativProduct]);
    }

    //============= VIEW CART ==============//
    public function cart()
    {
        return view('user.cart');
    }

    //============= VIEW CHECKOUT ==========//
    public function checkout()
    {
        return view('user.checkout');
    }
}
