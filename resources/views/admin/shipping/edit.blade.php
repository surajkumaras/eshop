@extends('admin.layout.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Shipping Management</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('shipping')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form id="updateShipping" method="post">
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
                                    <option value="" >State</option>
                                    @if (!empty($states))
                                        <option value="{{ $states->id}}" selected >{{ $states['state']->state}}</option>
                                       
                                    @endif
                                </select>	
                                <p></p>
                            </div>
                        </div>		
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="charge">Shipping Charges</label>
                                <input type="text" name="charge" id="charge" class="form-control" value="{{ $states->charge}}">
                                <p></p>	
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="pb-2 pt-3 pl-3">
                            <button class="btn btn-primary " id="btnSubmit">Update</button>
                            <a href="{{route('shipping')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>
                    </div>
                </div>							
            </div>
        </form>
        
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
        //================ UPDATE SHIPPING CHARGE CODE ============//
        
        let form = $("#updateShipping").submit(function(event)
        {
            event.preventDefault();

            var form = $(this)[0];
            var data = new FormData(form);   //------------>Collect form data

            $('#btnSubmit').prop("disabled",true);  //------>Disabled submit button after click

            $.ajax({
                url:"{{ route('shipping.update')}}",
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
                        
                        console.log(data['msg']);
                        $('#charge').removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");

                        setTimeout(() => {
                            window.location.href = "{{ route('shipping') }}";
                        }, 2000);
                    }
                    
                    if(data.status == false)
                    {
                        $('#btnSubmit').prop('disabled',false);
                        $('#charge').addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(data.errors.charge);
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
</script>