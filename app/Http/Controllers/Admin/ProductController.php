<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Brand;
use App\Models\SubCategory;
use App\Models\Category;
use App\Traits\ResponseJson;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    use ResponseJson;
    
    //=============== DISPLAY ALL PRODUCT ==============//
    public function list()
    {
        $data = Product::with('productImage')->get();
        return view('admin.product.product',['data'=>$data]);
    }

    
    //=============== ADD NEW PRODUCT ===============//
    public function add()
    {
        $cats   = Category::all();
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
        $validator = Validator::make($req->all(),
        [
            'brand'         =>'required',
            'category'      =>'required',
            'cross_price'   =>'required',
            'desc'          =>'required',
            'price'         =>'required',
            'status'        =>'required',
            'stock'         =>'required',
            'sub_category'  =>'required',
            'title'         =>'required'
        ]);

        if($validator->fails())
        {
            return $this->errorResponse($validator->errors()->all());
        }
        else
        {
            $product                = new Product;
            $product->name          = $req->title;
            $product->desc          = $req->desc;
            $product->price         = $req->price;
            $product->cross_price   = $req->cross_price;
            $product->category_id   = $req->category;
            $product->sub_cat_id    = $req->sub_category;
            $product->status        = $req->status;
            $product->stock         = $req->stock;
            $product->brand_id      = $req->brand;
            $product->save();

            if($req->hasFile('images'))
            {
                foreach($req->file('images') as $image)
                {
                    $pimage     = new ProductImage;
                    $imageName  = $image->getClientOriginalName();
                    $image->move(public_path().'/img/products/', $imageName);
                    $pimage->img = $imageName;
                    $product->productImage()->save($pimage);
                }

                return $this->insertResponse($product);
            }
        }
    }

    //====================== PRODUCT DELETE ====================//
    public function delete($id)
    {
        $data = Product::find($id);

        if($data)
        {
            $data->delete();
            return $this->deleteResponse($data);
        }
    }

    //====================== PRODUCT EDIT ===================//
    public function edit($id)
    {
       $data    = Product::with('productImage')->find($id);
       $cats    = Category::all();
       $brands  = Brand::all();
       $subcats = SubCategory::all();
       return view('admin.product.edit',['data'=>$data,'cats'=>$cats,'brands'=>$brands,'subcats'=>$subcats]);
    }

    //===================== UPDATE PRODUCT ==================//
    public function update(Request $req)
    {
        $product = Product::find($req->id);
        if($product)
        {
            $validator = Validator::make($req->all(),
            [
                'brand'         =>'required',
                'category'      =>'required',
                'cross_price'   =>'required',
                'desc'          =>'required',
                'price'         =>'required',
                'status'        =>'required',
                'stock'         =>'required',
                'sub_category'  =>'required',
                'title'         =>'required'
            ]);

            if($validator->fails())
            {
                return $this->errorResponse($validator->errors()->all());
            }
            else
            {
                $product->update([
                    'name'          => $req->title,
                    'price'         => $req->price,
                    'desc'          => $req->desc,
                    'cross_price'   => $req->cross_price,
                    'category_id'   => $req->category,
                    'sub_cat_id'    => $req->sub_category,
                    'brand_id'      => $req->brand,
                    'status'        => $req->status,
                    'stock'         => $req->stock
                ]);

                if ($req->hasFile('images')) 
                {
                    foreach ($req->file('images') as $image) 
                    {
                        $pimage         = new ProductImage;
                        $imageName      = $image->getClientOriginalName();
                        $image->move(public_path().'/img/products/', $imageName);
                        $existingImage  = $product->productImage()->where('img', $imageName)->first();
                
                        if ($existingImage) 
                        {
                            $existingImage->update([
                                'img' => $imageName,
                            ]);
                        } 
                        else 
                        {
                            $pimage->img = $imageName;
                            $product->productImage()->save($pimage);
                        }
                    }
                    return $this->updateResponse($product);
                }
                return $this->updateResponse($product);
            }
        }
    }
}
