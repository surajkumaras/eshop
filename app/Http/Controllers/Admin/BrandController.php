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

    //=================== DISPLAY ALL BRAND =================//
    public function show()
    {
        $data = Brand::all();
        return view('admin.brand.brand', ['data' => $data]);
    }

    //================== ADD NEW BRAND ====================//
    public function add(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'name'      =>  'required',
            'status'    =>  ['required',Rule::in(['1', '0']),],
        ]);

        if($validator->fails())
        {
            $msg = $validator->errors()->all();
            return $this->errorResponse($msg);
        }
        else 
        {
            if($req->hasFile('img'))
            {
                $imageName = $req->img->getClientOriginalName();
                $req->file('img')->move(public_path().'/img/brands/', $imageName);
            }

            $brand          = new Brand;
            $brand->name    = $req->name;
            $brand->status  = $req->status;
            $brand->image   = $imageName;
            $res            = $brand->save();

            if($res)
            {
                return $this->successResponse($brand);
            }
        }
        
    }

    //==================== EDIT BRAND ==================//
    public function edit($id)
    {
        $data = Brand::find($id);
        return view('admin.brand.edit',['data'=>$data]);
    }

    //==================== UPDATE BRAND ===============//
    public function update(Request $req)
    {
    
        $validator = Validator::make($req->all(),[
            'name'      =>  'required',
            'status'    =>  ['required',rule::in(['0','1'])],
        ]);

        if($validator->fails())
        {
            $msg = $validator->errors()->all();
            return $this->errorResponse($msg);
        }
        else 
        {
            $brand          = Brand::find($req->id);
            $brand->name    = $req->name;
            $brand->status  = $req->status;

            if($req->hasFile('img'))
            {
                $imageName  = $req->img->getClientOriginalName();
                $req->file('img')->move(public_path().'/img/brands/', $imageName);
                $brand->image = $imageName;
            }

            $res            = $brand->save();

            if($res)
            {
                return $this->updateResponse($brand);
            }

        }
    }

    //================ DELETE BRAND =================//
    public function delete($id)
    {
        $data = Brand::find($id);

        if($data)
        {
            $data->delete();
            return $this->deleteResponse($data);
        }
        else 
        {
            return $this->errorResponse($data);
        }
    }
}
