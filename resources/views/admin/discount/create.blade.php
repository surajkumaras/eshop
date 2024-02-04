@extends('admin.layout.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/datetimepicker.css')}}">
    <!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Discount Coupon</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('discount.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form id="addCoupon" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="code">Code</label>
                                <input type="text" name="code" id="code" class="form-control" placeholder="Code">
                                <p></p>	
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                <p></p>	
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="desc">Description</label>
                                <input type="text" name="desc" id="desc" class="form-control" placeholder="Description">
                                <p></p>	
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="max_uses">Max. Uses</label>
                                <input type="number" name="max_uses" id="max_uses" class="form-control" placeholder="Max. Uses">	
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="max_uses_user">Max. Uses User</label>
                                <input type="number" name="max_uses_user" id="max_uses_user" class="form-control" placeholder="Max. Uses User">	
                                <p></p>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Image</label>
                                <input type="file" name="img" id="img" class="form-control" placeholder="Name">	
                            </div>
                        </div>									 --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="type">Type</label>
                                <select class="form-control" name="type" id="type">
                                    <option  value="">Select Type</option>
                                    <option value="percentage">Percentage</option>
                                    <option value="fixed">Fixed</option>
                                </select>	
                                <p></p>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="discount_amount">Discount Amount</label>
                                <input type="number" name="discount_amount" id="discount_amount" class="form-control" placeholder="Discount Amount">
                                <p></p>	
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="min_amount">Min Amount</label>
                                <input type="number" name="min_amount" id="min_amount" class="form-control" placeholder="Min Amount">
                                <p></p>	
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start_at">Starts At</label>
                                <input type="text" name="start_at" id="start_at" class="form-control" placeholder="Starting At">	
                                <p></p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="expires_at">Expires At</label>
                                <input type="text" name="expires_at" id="expires_at" class="form-control" placeholder="Expiring At">	
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="" >Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>	
                                <p></p>
                            </div>
                        </div>
                        
                    </div>
                    {{-- <div class="row">
                        
                    </div> --}}
                </div>							
            </div>
            <div class="pb-5 pt-3">
                <button class="btn btn-primary " id="btnSubmit">Create</button>
                <a href="{{ route('discount.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
<script src="{{ asset('js/datetimepicker.js')}}"></script>

<script>
    

    $(document).ready(function()
    {
        $('#start_at').datetimepicker({
            // options here
            format:'Y-m-d H:i:s',
        });

        $('#expires_at').datetimepicker({
            // options here
            format:'Y-m-d H:i:s',
        });
        //================= ADD COUPON  ============//
        
        $('#code').keyup(function() 
        {
            $(this).val($(this).val().toUpperCase());  //------------->CONVERT CODE IN UPPER CASE
        });


        let form = $("#addCoupon").submit(function(event)
        {
            event.preventDefault();

            var form = $(this)[0];
            var data = new FormData(form);  //----------->COLLECT FORM DATA

            $('#btnSubmit').prop("disabled",true);

            $.ajax({
                url:"{{ route('discount.store') }}",
                method:'post',
                data:data,
                dataType:'json',
                processData:false,
                contentType:false,
                success:function(data)
                {
                    console.log(data);
                    $('#btnSubmit').prop('disabled',false);
                    

                    if(data.status == true)
                    {
                        let msg = data.message;
                        swal({
                            title: msg,
                            text: "Done!",
                            icon: "success",
                            button: "OK",
                        }).then((value) => {
                            if (value) 
                            {
                                window.location.href="{{ route('discount.index')}}"
                            }
                        });
                        
                    }
                    if(data.status == false)
                    {
                        
                        if(data.errors.name)
                        {
                            $('#name').addClass('is-invalid').siblings('p')
                            .addClass('invalid-feedback').html(data.errors['name']);
                        }
                        else 
                        {
                            $('#name').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        }

                        if(data.errors.code)
                        {
                            $('#code').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(data.errors['code']);
                        }
                        else 
                        {
                            $('#code').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        }

                        if(data.errors.desc)
                        {
                            $('#desc').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(data.errors['desc']);
                        }
                        else 
                        {
                            $('#desc').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        }

                        if(data.errors.status)
                        {
                            $('#status').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(data.errors['status']);
                        }
                        else 
                        {
                            $('#status').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        }

                        if(data.errors.type)
                        {
                            $('#type').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(data.errors['type']);
                        }
                        else 
                        {
                            $('#type').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        }

                        if(data.errors.max_uses)
                        {
                            $('#max_uses').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(data.errors['max_uses']);
                        }
                        else 
                        {
                            $('#max_uses').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        }

                        if(data.errors.max_uses_user)
                        {
                            $('#max_uses_user').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(data.errors['max_uses_user']);
                        }
                        else 
                        {
                            $('#max_uses_user').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        }

                        if(data.errors.discount_amount)
                        {
                            $('#discount_amount').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(data.errors['discount_amount']);
                        }
                        else 
                        {
                            $('#discount_amount').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        }

                        if(data.errors.min_amount)
                        {
                            $('#min_amount').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(data.errors['min_amount']);
                        }
                        else 
                        {
                            $('#min_amount').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        }

                        if(data.errors.start_at)
                        {
                            $('#start_at').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(data.errors['start_at']);
                        }
                        else 
                        {
                            $('#start_at').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        }

                        if(data.errors.expires_at)
                        {
                            $('#expires_at').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(data.errors['expires_at']);
                        }
                        else 
                        {
                            $('#expires_at').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        }
                    }

                    
                },
                error:function(err)
                {
                    $('#btnSubmit').prop('disabled',false);
                    swal("Somethings wents wrong!", "Failed!", "error");
                    
                }
            })
        })
    })
</script>
@endsection
