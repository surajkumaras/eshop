@extends('admin.layout.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Sub Category</h1>
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
        <form id="addSubCat" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Category</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select Category</option>
                                    @if ($data)
                                        @foreach ($data as $cat)
                                        <option value="{{ $cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    @endif
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Sub-Category Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Sub-Category Name">	
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Status</label>
                                <select name="status" class="form-control">
                                    <option  >Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>    
                                </select>	
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="img">Image</label>
                                <input type="file" name="img" id="img" class="form-control" placeholder="Slug">	
                            </div>
                        </div>									
                    </div>
                </div>							
            </div>
        
        <div class="pb-5 pt-3">
            <button class="btn btn-primary" id="btnSubmit">Create</button>
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
        //=============== ADD NEW SUB-CATEGORY ============//
        
        $("#addSubCat").submit(function(event)
        {
            event.preventDefault();
            
            let form = $(this)[0];
            let formData = new FormData(form);
            $('#btnSubmit').prop("disabled",true);

            $.ajax({
                url:"{{ route('subcategory.new')}}",
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