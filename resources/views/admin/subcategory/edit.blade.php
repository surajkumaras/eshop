@extends('admin.layout.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Sub Category</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('subcat.show')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form id="editSubCat" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Category</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select Category</option>
                                    @if ($cats)
                                        @foreach ($cats as $cat)
                                        <option value="{{ $cat->id}}" @if ($cat->id == $data->cat_id) selected @endif>{{$cat->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Sub-Category Name</label>
                                <input type="hidden" name="id" value="{{ $data->id}}"/>
                                <input type="text" name="name" value="{{ $data->name}}" id="name" class="form-control" placeholder="Sub-Category Name">	
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Status</label>
                                <select name="status" class="form-control">
                                    <option  >Select Status</option>
                                    <option value="1" @if ($data->status == '1') selected @endif>Active</option>
                                    <option value="0" @if ($data->status == '0') selected @endif>Deactive</option>    
                                </select>	
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="img">Image</label>
                                <input type="file" name="img" id="img" class="form-control" placeholder="Slug">	
                            </div>
                        </div>	
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name"></label>
                                    <img id="previewImage" src="{{ asset('img/subcategory/'.$data->image)}}" width="60px"  height="40px" style="border-radius: 5px; border:1px solid"/>	
                                </div>
                            </div>
                        </div>								
                    </div>
                </div>							
            </div>
        <div class="pb-5 pt-3">
            <button class="btn btn-primary" id="btnSubmit">Update</button>
            <a href="{{ route('subcat.show')}}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
    </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function()
    {
        //============= SHOW SELECTED IMAGE ==========//
        $("#img").on("change", function() 
        {
            var file = $(this)[0].files[0];
            var reader = new FileReader();

            reader.onload = function(e) 
            {
                $("#previewImage")
                    .attr("src", e.target.result)
                    .show();
            };

            reader.readAsDataURL(file);
        });

        //=============== EDIT SUB-CATEGORY ==============//

        $("#editSubCat").submit(function(event)
        {
            event.preventDefault();
            
            let form = $(this)[0];
            let formData = new FormData(form);
            $('#btnSubmit').prop("disabled",true);

            $.ajax({
                url:"{{ route('subcategory.update')}}",
                method:'post',
                data: formData,
                dataType:'json',
                processData:false,
                contentType:false,
                success:function(data)
                {
                    console.log(data);
                    window.location.href="{{route('subcat.show')}}"
                },
                error:function(err)
                {
                    console.log(err);
                }

            });
        })
    });
</script>