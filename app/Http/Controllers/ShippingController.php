<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\ShippingCharge;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ShippingController extends Controller
{
    public function show()
    {
        $states = State::all();
        $shipping_charges = ShippingCharge::with('state')->get();
        return view('admin.shipping.shipping', compact('states','shipping_charges'));
    }

    public function store(Request $req)
    {
        try{
            $shipping = ShippingCharge::where('state_id',$req->state)->first();
            if($shipping)
            {
                return response()->json(['status'=>false,'code'=>409,'msg' => 'Shipping charge already exists.']);
            }

            $validator = Validator::make($req->all(),[
                'state' => 'required',
                'charge' => 'required|numeric',
            ]);

            if($validator->fails())
            {
                return response()->json(['status'=>false,'errors' => $validator->errors()]);
            }
            else 
            {
                $shipping = new ShippingCharge;
                $shipping->state_id = $req->state;
                $shipping->charge = $req->charge;
                $shipping->save();

                $shipping_charges = ShippingCharge::with('state')->get();
                return response()->json(['status'=>true,'success' => 'Shipping charge added successfully.','shipping_charges'=>$shipping_charges]);
            }
            
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }


    public function edit($id)
    {
        $data = ShippingCharge::with('state')->where('id', $id)->first();
        return view('admin.shipping.edit', ['states' => $data]);
    }

    public function update(Request $req)
    {
        try
        {
            $validator = Validator::make($req->all(),[
                'state' => 'required',
                'charge' => 'required|numeric',
            ]);

            if($validator->fails())
            {
                return response()->json(['status'=>false,'errors' => $validator->errors()]);
            }

            DB::table('shipping_charges')->where('state_id', '=', $req->state)->update(['charge' => $req->charge]);

            return response()->json(['status'=>true,'msg' => 'Shipping charge updated successfully.']);

        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        $data = ShippingCharge::find($id);
        $data->delete();
        return response()->json(['status'=>true,'code'=>200,'msg' => 'Shipping charge deleted successfully.']);
    }
}
