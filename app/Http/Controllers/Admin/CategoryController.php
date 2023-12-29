<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Traits\ResponseJson;

class CategoryController extends Controller
{
    use ResponseJson;

    //=================== SHOW ALL CATEGORY =====================//
    public function show()
    {
        $data = Category::all();

        return view('admin.category.category',['data'=>$data]);
    }

    //=================== ADD CATEGORY =====================//
    public function new()
    {
        return view('admin.category.addcategory');
    }


    //=================== ADD NEW CATEGORY ======================//
    public function add(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'name'  =>'required',
            'status'=> ['required',rule::in(['0','1'])]
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
                $req->file('img')->move(public_path().'/img/category/', $imageName);
            }

            $cat            = new Category;
            $cat->name      = $req->name;
            $cat->status    = $req->status;
            $cat ->image    = $imageName;
            $res            = $cat->save();

            if($res)
            {
                return $this->successResponse($cat);
            }
            else 
            {
                $msg = "Error in Category";
                return $this->errorResponse($msg);
            }

        }
    }

    //================ EDIT ===============//
    public function edit($id)
    {
        // return $id;
        $data = Category::find($id);

        return view('admin.category.edit',['data'=>$data]);
    }

    //=============== UPDATE ==============//
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
            $cat          = Category::find($req->id);
            $cat->name    = $req->name;
            $cat->status  = $req->status;

            if($req->hasFile('img'))
            {
                $imageName  = $req->img->getClientOriginalName();
                $req->file('img')->move(public_path().'/img/category/', $imageName);
                $cat->image = $imageName;
            }

            $res            = $cat->save();

            if($res)
            {
                return $this->updateResponse($cat);
            }

        }
    }

    //================ DELETE =============//
    public function delete($id)
    {
        $data = Category::find($id);

        if($data)
        {
            $data->delete();

            return $this->deleteResponse($data);
        }
    }
}
