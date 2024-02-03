@extends('admin.layout.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Shipping Management</h1>
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
        <form id="addShipping" method="post">
            @csrf
            <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="counter">Country</label>
                                <input type="text" name="counter" id="counter" class="form-control" placeholder="India" disabled>	
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="state">State</label>
                                <select class="form-control" name="state" id="state">
                                    <option value="" >Select State</option>
                                    @if (!empty($states))
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id}}" >{{ $state->state}}</option>
                                        @endforeach
                                    @endif
                                </select>	
                                <p></p>
                            </div>
                        </div>		
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="charge">Shipping Charges</label>
                                <input type="text" name="charge" id="charge" class="form-control" placeholder="Shipping Charges">
                                <p></p>	
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="pb-2 pt-3 pl-3">
                            <button class="btn btn-primary " id="btnSubmit">Add</button>
                            <a href="{{route('brand.show')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>
                    </div>
                </div>							
            </div>
        </form>
        <div class="card">
            <div class="card-body">								
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>State</th>
                                <th>Charges</th>
                                <th>Action</th>
                            </tr>
                            @if (!empty($shipping_charges))
                                @foreach ($shipping_charges as $charge)
                                    <tr>
                                        <td>{{ $charge->id}}</th>
                                        <td>{{$charge['state']->state}}</th>
                                        <td>{{ $charge->charge}}</th>
                                        <td>
                                            <a href="{{ route('shipping.edit',$charge->id)}}" class="btn btn-info">Edit</a>
                                            <a href="javascript:void(0);" onclick="deleteData({{$charge->id}})" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>  
<script>
    $(document).ready(function()
    {
        //================ ADD SHIPPING CHARGE CODE ============//
        
        let form = $("#addShipping").submit(function(event)
        {
            event.preventDefault();

            var form = $(this)[0];
            var data = new FormData(form);   //------------>Collect form data

            $('#btnSubmit').prop("disabled",true);  //------>Disabled submit button after click

            $.ajax({
                url:"{{ route('shipping.store')}}",
                method:'post',
                data:data,
                dataType:'json',
                processData:false,
                contentType:false,
                success:function(data)
                {
                    console.log(data);
                    if(data.status == true)
                    {
                        $('#btnSubmit').prop('disabled',false);
                        
                        swal("Shipping Charges Added!", "Done!", "success");
                        form.reset();  //------>Reset form after submit
                    }
                    
                    if(data.status == false)
                    {
                        if(data.errors && data.errors['state'])
                        {
                            $('#btnSubmit').prop('disabled',false);
                            $('#state').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(data.errors.state);
                        }
                        else 
                        {
                            $('#state').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        }

                        if(data.errors && data.errors['charge'])
                        {
                            $('#btnSubmit').prop('disabled',false);
                            $('#charge').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(data.errors.charge);
                        }
                        else 
                        {
                            $('#charge').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        }

                        if(data.code == 409)
                        {
                            console.log(data.msg);
                            $('#btnSubmit').prop('disabled',false);
                            swal(data.msg,"" , "warning");
                        }
                    }

                },
                error:function(err)
                {
                    console.log(err);
                    $('#btnSubmit').prop('disabled',false);
                }
            })
        })

        
    })

    //====================== DELETE ====================//
    function deleteData(stateId) 
    {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        let id = stateId;

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/shipping/delete/' + id,
                    type: 'delete',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function (data) {
                        if (data.code == 200) {
                            swal("Poof! Your data has been deleted!", {
                                icon: "success",
                            });
                        }
                    },
                    error: function (err) {
                        console.log(err)
                    }
                });
            } else {
                swal("Your imaginary file is safe!");
            }
        }).then(function() {
            setTimeout(() => {
                location.reload();
            }, 1000);
            
        });
    }

</script>