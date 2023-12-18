<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;
use App\Traits\ResponseJson;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    use ResponseJson;

    public function show()
    {
        $data = Brand::all();

        return view('admin.brand.brand', ['data' => $data]);
    }

    public function add(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'name'=>'required',
            'status'=>[
                'required',Rule::in(['1', '0']),
            ],
        ]);

        if($validator->fails())
        {
            $msg = $validator->errors()->all();
            return $this->errorResponse($msg);
        }
        else 
        {
            $brand = new Brand;
            $brand->name = $req->name;
            $brand->status = $req->status;
            $res = $brand->save();

            if($res)
            {
                return $this->successResponse($brand);
            }
        }
        
    }
}
