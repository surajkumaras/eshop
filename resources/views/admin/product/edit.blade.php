@extends('admin.layout.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Product</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('product.list')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="editProduct" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">								
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="title">Title</label>
                                        <input type="hidden" value="{{ $data->id}}" name="id">
                                        <input type="text" value="{{$data->name}}" name="title" id="title" class="form-control" placeholder="Title">	
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="desc">Description</label>
                                        <textarea name="desc"  id="desc" cols="60" rows="3" class="form-control" placeholder="Description">{{$data->desc}}</textarea>
                                    </div>
                                </div>                                            
                            </div>
                        </div>	                                                                      
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Media</h2>								
                            <div>
                                <input type="file" name="images[]" class="form-control" multiple>
                            </div>
                        </div>	                                                                      
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div>
                                @if ($data->productImage->isNotEmpty())
                                    @foreach ($data->productImage as $image )
                                        <img id="previewImage" src="{{ asset('img/products/'.$image['img'])}}" width="60px"  height="40px" style="border-radius: 5px; border:1px solid"/>
                                    @endforeach
                                @endif
                            </div>
                        </div>	                                                                      
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">								
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="price">Price</label>
                                        <input type="text" value="{{ $data->price}}" name="price" id="price" class="form-control" placeholder="Discount Price">	
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="cross_price">Compare at Price</label>
                                        <input type="text" value="{{ $data->cross_price}}" name="cross_price" id="cross_price" class="form-control" placeholder="Original Price">
                                    </div>
                                </div>                                            
                            </div>
                        </div>	                                                                      
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">	
                            <h2 class="h4 mb-3">Product status</h2>
                            <div class="mb-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="1" @if ($data->status == '1') selected @else @endif>Active</option>
                                    <option value="0" @if ($data->status == '0') selected @else @endif>Block</option>
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="card">
                        <div class="card-body">	
                            <h2 class="h4  mb-3">Product category</h2>
                            <div class="mb-3">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select Category</option>
                                        @if($cats)
                                            @foreach ($cats as $cat)
                                                <option value="{{ $cat->id}}" @if ($cat->id == $data->category_id)selected
                                                @endif>{{ $cat->name}}</option>
                                            @endforeach
                                        @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="sub_category">Sub category</label>
                                <select name="sub_category" id="sub_category" class="form-control">
                                    <option value="">Select Sub-Category</option>
                                        @if($subcats)
                                            @foreach ($subcats as $subcat )
                                                <option value="{{ $subcat->id}}" @if ($data->sub_cat_id == $subcat->id)
                                                    selected
                                                @endif>{{ $subcat->name}}</option>
                                            @endforeach
                                        @endif
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="card mb-3">
                        <div class="card-body">	
                            <h2 class="h4 mb-3">Product brand</h2>
                            <div class="mb-3">
                                <select name="brand" id="brand" class="form-control">
                                    <option value="">Select Brand</option>
                                    @if ($brands)
                                        @foreach ($brands as $brand )
                                            <option value="{{ $brand->id}}" @if ($data->brand_id == $brand->id)
                                                selected
                                            @endif>{{ $brand->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Inventory</h2>								
                            <div class="mb-3">
                                <label for="stock">Stocks</label>
                                <input type="number" name="stock" value="{{ $data->stock}}" id="stock" class="form-control" placeholder="Enter Stocks">	
                            </div>
                        </div>	                                                                      
                    </div> 
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button id="btnSubmit" class="btn btn-primary">Update</button>
                <a href="{{ route('product.list')}}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function()
    {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $("#category").change(function()
        {
           let id = $(this).val();

           $.ajax({
                url:"/subcategory/detail/"+id,
                method:'get',
                dataType:'json',
                headers: { 'X-CSRF-TOKEN': csrfToken },
                success:function(data)
                {
                    console.log(data);
                    $("#sub_category").find('option:not(:first)').remove();
                    if(data['data'].length >0)
                    {
                        $.each(data['data'],function(key,value)
                        {
                            $("#sub_category").append("<option value="+value['id']+ ">"+value['name']+"</option>")
                        });
                    }
                },
                error:function(err)
                {
                    console.log(err);
                }
            })
        });

        //===================== EDIT PRODUCT ==============//
        
        $("#editProduct").submit(function(event)
        {
            event.preventDefault();

            var form = $(this)[0];
            var data = new FormData(form);

            $('#btnSubmit').prop("disabled",true);

            $.ajax({
                url:"{{ route('product.update')}}",
                method:'post',
                data:data,
                dataType:'json',
                processData:false,
                contentType:false,
                success:function(data)
                {
                    console.log(data);
                    $('#btnSubmit').prop('disabled',false);
                    swal("Good job!", "You clicked the button!", "success");

                    setTimeout(() => {
                        window.location.href="{{route('product.list')}}"
                    }, 3000);
                    
                },
                error:function(err)
                {
                    console.log(err);
                    $('#btnSubmit').prop('disabled',false);
                }
            })
        })
    })
</script>
@endsection
