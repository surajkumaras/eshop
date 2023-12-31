@extends('admin.layout.app')

@section('content')

    <!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update Brand</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('brand.show')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form id="editBrand" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{ $data->name}}" class="form-control" placeholder="Name">
                                <input type="hidden" name="id" value="{{ $data->id}}">	
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email">Status</label>
                                <select class="form-control" name="status">
                                    <option  >Select Status</option>
                                    <option value="1" @if ($data->status == '1') selected @endif>Active</option>
                                    <option value="0" @if ($data->status == '0') selected @endif>Deactive</option>
                                </select>	
                            </div>
                        </div>									
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Image</label>
                                <input type="file" name="img" id="img" class="form-control" >	
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name"></label>
                                <img id="previewImage" src="{{ asset('img/brands/'.$data->image)}}" width="60px"  height="40px" style="border-radius: 5px; border:1px solid"/>	
                            </div>
                        </div>
                    </div>
                </div>							
            </div>
            <div class="pb-5 pt-3">
                <button class="btn btn-primary " id="btnSubmit">Update</button>
                <a href="{{ route('brand.show')}}" class="btn btn-outline-dark ml-3">Cancel</a>
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
        $("#img").on("change", function()  //----------> DISPLAY IMAGE
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

        //--------------- EDIT BRAND ------------------//

        $("#editBrand").submit(function(event)
        {
            event.preventDefault();

            let form = $(this)[0];
            let formData = new FormData(form);

            $("#btnSubmit").prop('disabled',true);

            $.ajax({
                url:"{{ route('brand.update')}}",
                method:'post',
                data:formData,
                dataType:'json',
                processData:false,
                contentType:false,
                success:function(data)
                {
                    console.log(data);
                    $("#btnSubmit").prop('disabled',false);
                    swal("Brand Updated!", "Done!", "success");
                    setTimeout(() => {
                        window.location.href="{{ route('brand.show')}}"
                    }, 3000);
                },
                error:function(err)
                {
                    console.log(err);
                    $("#btnSubmit").prop('disabled',false);
                }
            });
        });
    });
</script>