@extends('admin.layout.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Brand</h1>
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
        <form id="addBrand" method="post">
            @csrf
            <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">	
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email">Status</label>
                                <select class="form-control" name="status">
                                    <option  >Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
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
                </div>							
            </div>
            <div class="pb-5 pt-3">
                <button class="btn btn-primary " id="btnSubmit">Create</button>
                <a href="brands.html" class="btn btn-outline-dark ml-3">Cancel</a>
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
        let form = $("#addBrand").submit(function(event)
        {
            event.preventDefault();

            var form = $(this)[0];
            var data = new FormData(form);

            $('#btnSubmit').prop("disabled",true);

            $.ajax({
                url:"{{ route('brand.add.new')}}",
                method:'post',
                data:data,
                dataType:'json',
                processData:false,
                contentType:false,
                success:function(data)
                {
                    console.log(data);
                    $('#btnSubmit').prop('disabled',false);
                    window.location.href="{{route('brand.show')}}"
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