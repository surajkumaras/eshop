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
use App\Models\Order;
use App\Models\OrderItem;
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

    //====================== SAVE PAYMENT DETAILS ===================//
    public function checkoutPayment(Request $req)
    {
        try{
            $user_id = auth()->user()->id;
    
            $cartItem = Cart::with('product')->where('user_id',$user_id)->get();
           // return $cartItem;
            $subtotal = 0;
            $qnty = 0;
            foreach($cartItem as $item)
            {
               $subtotal += $item->product->price * $item->qnty;  //subtotal of all items in cart
    
            }
            $shipping_charge = 20;  //shipping charge
            $gst_value = ($subtotal * 18) / 100;  //gst amount
            $total_amount = $subtotal + $gst_value + $shipping_charge;  //total amount
    
            $order = new Order;
            $order->user_id = $user_id;
            $order->total = $subtotal;
            $order->shipping = $shipping_charge;
            $order->gst = $gst_value;
            $order->subtotal = $total_amount;
            $order->coupan_code = $req->coupan_code?$req->coupan_code:'null';
            $order->coupan_discount = $req->coupan_discount?$req->coupan_discount:'0.0';
            $order->payment_method = $req->payment_method;
            $order->order_status = 'Pending';
            $order->payment_status = $req->payment_status == 'COD'?'Pending':'Paid';
            $order->name = $req->full_name;
            $order->email = $req->email;
            $order->mobile = $req->mobile;
            $order->address = $req->address;
            $order->city = $req->city;
            $order->state = $req->state;
            $order->country = $req->country;
            $order->pincode = $req->zip;
            $order->landmark = $req->appartment?$req->appartment:'';
            $order->note = $req->order_notes?$req->order_notes:'';
            $order->save();
    
            $order_id = $order->id; //order id of current order
    
            foreach ($cartItem as $key => $product) 
            { 
                $order_item = new OrderItem;
                $order_item->order_id = $order_id;
                $order_item->product_id = $product['product_id'];
                $order_item->name = $product['product']['name'];
                $order_item->quantity = $product['qnty'];
                $order_item->price = $product['product']['price'];
                $order_item->total_price = $product['product']['price'] * $product['qnty'];
                $order_item->save();
            }
    
            Cart::where('user_id', $user_id)->delete();
            return response()->json(['status' => 'success', 'message' => 'Order Placed Successfully', 'order_id' => $order_id]);
        } 
        catch (Throwable $e) 
        {
            report($e);
    
            return false;
        }
    }
}
