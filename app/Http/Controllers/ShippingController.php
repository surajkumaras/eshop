<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\ShippingCharge;

class ShippingController extends Controller
{
    public function show()
    {
        $states = State::all();
        return view('admin.shipping', compact('states'));
    }

    public function store(Request $req)
    {
        try{
            $shipping = new ShippingCharge;
            $shipping->state_id = $req->state;
            $shipping->charge = $req->charge;
            $shipping->save();

            return response()->json(['success' => 'Shipping charge added successfully.']);
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function getCity(Request $req)
    {
        $state_id = $req->state_id;

        $charge = ShippingCharge::where('state_id', $state_id)->first();
        return response()->json(['charge' => $charge->charge]);
    }
}
