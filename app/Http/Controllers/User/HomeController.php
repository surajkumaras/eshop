<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Cart;
use App\Models\User;
use App\Models\Wishlist;
use App\Traits\ResponseJson;


class HomeController extends Controller
{
    use ResponseJson;

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

    //============= ADD INTO CART ==============//
    public function cart(Request $req)
    {
        $user_id = auth()->user()->id;
        $data = Cart::where('product_id',$req->product_id)->where('user_id',$user_id)->get();
        if($data->isNotEmpty())
        {
            return response()->json(['status'=> false, 'code'=>500, 'msg'=>'Product already in your cart']);
        }

        $user_id = auth()->user()->id;
        $product_id = $req->product_id;

        $cart = new Cart;
        $cart->product_id = $product_id;
        $cart->user_id = $user_id;
        $cart->save();
        return $this->insertResponse($cart);
    }

    //============= SHOW CART ITEMS =======//
    public function showCart()
    {   
        $user_id = auth()->user()->id;
        $data = DB::table('carts')
                ->join('products','products.id','=','carts.product_id')
                ->join('product_images','products.id','=','product_images.product_id')
                ->select('products.*','carts.qnty','carts.user_id','product_images.img')
                ->where('user_id',$user_id)
                ->get();
        //return $data ;
        return view('user.cart',['items'=>$data]);
    }

    //============= CART UPDATE ============//
    public function updateCart(Request $req)
    {
        return $req;
    }

    //============= CART DELETE ============//
    public function deleteCart($id)
    {
        //return $id;
        $user_id = auth()->user()->id;
        $cartItem = Cart::where('product_id',$id)->where('user_id',$user_id)->first();
        
        if (!$cartItem) 
        {
            return $this->deleteResponse(false, 'Cart item not found.');
        }

        $res = $cartItem->delete();

        if($res)
        {
            return $this->deleteResponse($res);
        }
    }

    //============= VIEW CHECKOUT ==========//
    public function checkout()
    {
        $user_id = auth()->user()->id;
        $data = DB::table('carts')
                ->join('products','products.id','=','carts.product_id')
                
                ->select('products.name','products.price','carts.qnty')
                ->where('user_id',$user_id)
                ->get();

        //return $data;
        return view('user.checkout',['items'=>$data]);
    }

    public function showWishlist()
    {
        $user_id = auth()->user()->id;
        $data = DB::table('wishlists')
                ->join('products','products.id','=','wishlists.product_id')
                ->join('product_images','product_images.product_id','=','products.id')
                ->get();

        //return $data;
        return view('user.wishlist',['items'=>$data]);
    }

    //============== ADD INTO WISHLIST ===========//
    public function addWishlist(Request $req)
    {
        $p_id =  $req->id;
        $user_id = auth()->user()->id;
        
        $item = Wishlist::where('product_id',$p_id)->where('user_id',$user_id)->first();

        if($item)
        {
            return response()->json(['status'=>false, 'code'=>409, 'msg'=>'Item already in your wishlist']);
        }

        $data = new Wishlist;
        $data->product_id = $req->id;
        $data->user_id = $user_id;
        $res = $data->save();

        if($res)
        {
            return $this->insertResponse($res);
        }
    }

    //=============== REMOVE WISHLIST ITEM ===========//
    public function deleteWishlist(Request $req)
    {
        $p_id =  $req->product_id;
        $user_id = auth()->user()->id;

        $item = Wishlist::where('product_id',$p_id)->where('user_id',$user_id)->first();
        $res = $item->delete();
        if($res)
        {
            return $this->deleteResponse($res);
        }
    }
}
