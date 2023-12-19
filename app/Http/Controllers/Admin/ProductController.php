<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\SubCategory;
use App\Models\Category;
use App\Traits\ResponseJson;

class ProductController extends Controller
{
    use ResponseJson;
    //=============== DISPLAY ALL PRODUCT ==============//
    public function list()
    {
        

       // return $data;

       return view('admin.product.product');
    }

    
    //=============== ADD NEW PRODUCT ===============//
    public function add()
    {
        $cats = Category::all();
        
        $brands = Brand::all();

        return view('admin.product.addProduct',['cats'=>$cats,  'brands'=>$brands]);
    }

    //=============== SUB-CATEGORY ==================//
    public function getSubCat($id)
    {
        $subcats = SubCategory::where('cat_id',$id)->get();
        return $this->successResponse($subcats);
    }

    //============== CREATE NEW PRODUCT ==============//
    public function create(Request $req)
    {
        return $req;
    }
}
