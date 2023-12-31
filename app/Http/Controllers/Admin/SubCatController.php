<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Traits\ResponseJson;

class SubCatController extends Controller
{
    use ResponseJson;

    //=================== SHOW ALL SUB-CATEGORY ================//
    public function show()
    {
        $data = SubCategory::with('category')->get();
        return view('admin.subcategory.sub-category', ['data'=>$data]);
    }

    //=================== SHOW CATEGORY IN SELECT OPTION =======//
    public function add()
    {
        $data = Category::select('id','name')->get();
        return view('admin.subcategory.newsubCategory', ['data'=>$data]);
    }

    //=================== ADD NEW SUB-CATEGORY =================//
    public function save(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'name'=>'required',
            'category'=>'required',
            'status'=>['required',rule::in(['0','1'])]
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
                $req->file('img')->move(public_path().'/img/subcategory/', $imageName);
            }

            $subcat         = new SubCategory;
            $subcat->name   = $req->name;
            $subcat->status = $req->status;
            $subcat->cat_id = $req->category;
            $subcat ->image = $imageName;
            $res            = $subcat->save();

            if($res)
            {
                return $this->successResponse($subcat);
            }
            else 
            {
                $msg = "Error in Category";
                return $this->errorResponse($msg);
            }
        }
    }

    //================== EDIT ==================//
    public function edit($id)
    {
        $data = SubCategory::with('category')->find($id);
        $cats = Category::all();
        if($data)
        {
            return view('admin.subcategory.edit',['data'=>$data, 'cats'=>$cats]);
        }
    }

    //================== UPDATE =================//
    public function update(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'name'      =>  'required',
            'category'  =>  'required',
            'status'    =>  ['required',rule::in(['0','1'])],
        ]);

        if($validator->fails())
        {
            $msg = $validator->errors()->all();
            return $this->errorResponse($msg);
        }
        else 
        {
            $subcat          = SubCategory::find($req->id);
            $subcat->name    = $req->name;
            $subcat->status  = $req->status;
            $subcat->cat_id  = $req->category;

            if($req->hasFile('img'))
            {
                $imageName  = $req->img->getClientOriginalName();
                $req->file('img')->move(public_path().'/img/subcategory/', $imageName);
                $subcat->image = $imageName;
            }

            $res            = $subcat->save();

            if($res)
            {
                return $this->updateResponse($subcat);
            }

        }
    }

    //================== DELETE ===================//
    public function delete($id)
    {
        $data = SubCategory::find($id);

        if($data)
        {
            $data->delete();
            return $this->deleteResponse($data);
        }
    }
}
