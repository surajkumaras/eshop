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
                                    <option value="0" >Select State</option>
                                    @if (!empty($states))
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id}}" >{{ $state->state}}</option>
                                        @endforeach
                                    @endif
                                </select>	
                            </div>
                        </div>		
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="charge">Shipping Charges</label>
                                <input type="text" name="charge" id="charge" class="form-control" placeholder="Name">	
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        
                    </div>
                </div>							
            </div>
            <div class="pb-5 pt-3">
                <button class="btn btn-primary " id="btnSubmit">Update</button>
                <a href="{{route('brand.show')}}" class="btn btn-outline-dark ml-3">Cancel</a>
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
                    $('#btnSubmit').prop('disabled',false);
                    swal("Shipping Charges Added!", "Done!", "success");
                    form.reset();  //------>Reset form after submit
                },
                error:function(err)
                {
                    console.log(err);
                    $('#btnSubmit').prop('disabled',false);
                }
            })
        })

        $('#state').change(function()
        {
            var state_id = $(this).val();
            $.ajax({
                url:"{{ route('city') }}",
                type:'post',
                data:{state_id:state_id, _token:'{{ csrf_token() }}'},
                dataType:'json',
                success:function(data)
                {
                    console.log(data);
                    $('#charge').val(data.charge);
                },
                error:function(err)
                {
                    console.log(err);
                }
            })
        });
    })
</script>