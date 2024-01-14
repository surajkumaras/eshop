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

class CartController extends Controller
{
    use ResponseJson;

    //============= ADD INTO CART ==============//
    public function cart(Request $req)
    {
        $user_id = auth()->user()->id;

        $data = Cart::where('product_id',$req->product_id)->where('user_id',$user_id)->get();
        if($data->isNotEmpty())
        {
            return response()->json(['status'=> false, 'code'=>500, 'msg'=>'Product already in your cart']);
        }

        $user_id    = auth()->user()->id;
        $product_id = $req->product_id;

        $cart = new Cart;
        $cart->product_id = $product_id;
        $cart->user_id    = $user_id;
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

        $totalAmount = 0;
        
        foreach($data as $item)
        {
            $totalAmount += $item->qnty * $item->price;
        }
        return view('user.cart',['items'=>$data,'totalAmount'=>$totalAmount]);
    }

    //============= CART UPDATE ============//
    public function updateCart(Request $req)
    {
        $user_id = auth()->user()->id;
        $pid = $req->p_id;
        $qnty = $req->qnty;

        $res = DB::table('carts')
            ->where('user_id',$user_id)
            ->where('product_id',$pid)
            ->update(['qnty'=>$qnty]);

        if($res)
        {
            $data = DB::table('carts')
                ->join('products','products.id','=','carts.product_id')
                ->select('products.price','carts.qnty')
                ->where('user_id',$user_id)
                ->get();

                $totalAmount = 0;

                foreach($data as $item)
                {
                    $totalAmount += $item->qnty * $item->price;
                }
            //return $this->updateResponse($res);

            return response()->json(['staus'=>true, 'code'=>200, 'msg'=> 'Cart Updated!', 'totalAmount'=>$totalAmount]);
        }

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
    {$user_id = auth()->user()->id;
        $user = User::with('address')->find($user_id);

        
        
        $data = DB::table('carts')
                ->join('products','products.id','=','carts.product_id')
                ->select('products.name','products.price','carts.qnty')
                ->where('user_id',$user_id)
                ->get();

        $totalAmount = 0;

        foreach($data as $item)
        {
            $totalAmount += $item->qnty * $item->price;
        }

        //return $data;
        return view('user.checkout',['items'=>$data,'totalAmount'=>$totalAmount,'user'=>$user]);
    }
}
