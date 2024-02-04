<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DiscountCoupon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class DiscountCouponController extends Controller
{
    public function index()
    {
        $discounts = DiscountCoupon::all();
        return view('admin.discount.index',['discounts' => $discounts]);
    }

    public function create()
    {
        return view('admin.discount.create');
    }

    public function store(Request $request)
    {
        try{
            //return $request->all();
            $validator = Validator::make($request->all(), [
                'code' => 'required|unique:discount_coupons',
                'name' => 'required|unique:discount_coupons',
                'desc' => 'required',
                'max_uses' => 'required|numeric',
                'max_uses_user' => 'required|numeric',
                'type' => 'required',
                'discount_amount' => 'required|numeric',
                'min_amount' => 'required',
                'start_at' => 'required|date',
                'expires_at' => 'required|date|after_or_equal:start_date',
                // 'percentage' => 'required|numeric',
                'status' => 'required',
            ]);

            if($validator->fails())
            {
                return response()->json(['status'=>false,'errors' => $validator->errors()]);
            }

            //--------- Starting date must be grater then current date -----//
            if(!empty($request->start_at))
            {
                $current_date = Carbon::now();
                $start_date = Carbon::createFromFormat('Y-m-d H:i:s',$request->start_at);

                if($start_date <= $current_date)
                {
                    return response()->json(['status'=>false,'errors' => ['start_at' => 'Starting date must be grater then current date']]);
                }
            }

            //--------- Expring date must be grater then Starting data ------//
            if(!empty($request->expires_at))
            {
                $start_date = Carbon::createFromFormat('Y-m-d H:i:s',$request->start_at);
                $expire_date = Carbon::createFromFormat('Y-m-d H:i:s',$request->expires_at);

                if($start_date >= $expire_date)
                {
                    return response()->json(['status'=>false,'errors' => ['expires_at' => 'Expiry date must be grater then Starting date']]);
                }
            }

            $discount               = new DiscountCoupon();
            $discount->code         = $request->code;
            $discount->name         = $request->name;
            $discount->description  = $request->desc;
            $discount->max_uses     = $request->max_uses;
            $discount->max_uses_user = $request->max_uses_user;
            $discount->type         = $request->type;
            $discount->discount_amount = $request->discount_amount;
            $discount->min_amount   = $request->min_amount;
            $discount->starts_at     = $request->start_at;
            $discount->expires_at   = $request->expires_at;
            $discount->status       = $request->status;
            $discount->save();

            return response()->json(['status'=>true,'message' => 'Discount Coupon created successfully']);

            
        }
        catch(\Exception $e)
        {
            return response()->json(['errors' => [$e->getMessage()]], 500);
        }
    }

    public function edit($id)
    {
        // return $id;
        $discount = DiscountCoupon::find($id);
        // return $discount;
        return view('admin.discount.edit',compact('discount'));
    }

    public function update(Request $request)
    {
       try{

            $validator = Validator::make($request->all(),[
                'code' => 'required',
                'name' => 'required',
                'desc' => 'required',
                'max_uses' => 'required|numeric',
                'max_uses_user' => 'required|numeric',
                'type' => 'required',
                'discount_amount' => 'required|numeric',
                'min_amount' => 'required',
                'start_at' => 'required|date',
                'expires_at' => 'required|date',
                'status' => 'required',
            ]);

            if($validator->fails())
            {
                return response()->json(['status'=>false,'errors' => $validator->errors()]);
            }

            $discount = DiscountCoupon::find($request->coupon_id);

            if($discount->code != $request->code)
            {
                $check_code = DiscountCoupon::where('code',$request->code)
                                            ->where('id','!=',$request->coupon_id)->first();
                if($check_code)
                {
                    return response()->json(['status'=>false,'errors' => ['code' => ['This code is already exists']]], 401);
                }
            }

            //--------- Expring date must be grater then Starting data ------//
            if(!empty($request->expires_at))
            {
                $start_date = Carbon::createFromFormat('Y-m-d H:i:s',$request->start_at);
                $expire_date = Carbon::createFromFormat('Y-m-d H:i:s',$request->expires_at);

                if($start_date >= $expire_date)
                {
                    return response()->json(['status'=>false,'errors' => ['expires_at' => 'Expiry date must be grater then Starting date']]);
                }
            }
            
            $discount->code = $request->code;
            $discount->name = $request->name;
            $discount->description = $request->desc;
            $discount->max_uses = $request->max_uses;
            $discount->max_uses_user = $request->max_uses_user;
            $discount->type = $request->type;
            $discount->discount_amount = $request->discount_amount;
            $discount->min_amount = $request->min_amount; 
            $discount->starts_at = $request->start_at;
            $discount->expires_at   = $request->expires_at;
            $discount->status       = $request->status;
            $discount->save();

            return response()->json(['status'=>true,'msg' => 'Discount Coupon updated successfully'], 200);

       }catch(\Exception $e)
       {
            return response()->json(['errors' => [$e->getMessage()]], 500);
       }

       
    }

    public function destory($id)
    {
        try{
            $data = DiscountCoupon::find($id);

            if($data)
            {
                $data->delete();
                return response()->json(['status'=>true,'msg' => 'Discount Coupon deleted successfully']);
            }
        }catch(\Exception $e)
        {
            return response()->json(['errors'=> $e->getMessage()]);
        }
    }
}
