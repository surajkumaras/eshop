@extends('admin.layout.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Discount-Coupon</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('discount.create')}}" class="btn btn-primary">New Coupon</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="card">
            
            <div class="card-body table-responsive p-0">								
                <table class="table table-hover text-nowrap" id="categoryTable">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Max. Uses</th>
                            <th>Max. Uses User</th>
                            <th width="100">Type</th>
                            <th>Discount Amount</th>
                            <th>Min. Amount</th>
                            <th>Starts Date</th>
                            <th>Expires Date</th>
                            <th width="100">Status</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($discounts)
                            @foreach ($discounts as $coupon)
                                    
                                
                            <tr>
                                <td>{{ $coupon->id}}</td>
                                <td>{{ $coupon->code}}</td>
                                <td>{{$coupon->name}}</td>
                                <td>{{$coupon->description}}</td>
                                <td>{{$coupon->max_uses}}</td>
                                <td>{{$coupon->max_uses_user}}</td>
                                <td>{{$coupon->type}}</td>
                                <td>{{$coupon->discount_amount}}</td>
                                <td>{{$coupon->min_amount}}</td>
                                <td>{{$coupon->starts_at}}</td>
                                <td>{{$coupon->expires_at}}</td>
                                {{-- <td>{{$coupon->status}}</td> --}}
                                <td>
                                    @if($coupon->status == '0')
                                        <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @else ()
                                        <svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('discount.edit', ['id'=>$coupon->id])}}">
                                        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </a>
                                    <a value="{{$coupon->id}}" class="del text-danger w-4 h-4 mr-1">
                                        <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </td> 
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>										
            </div>
            
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

<script>
    $(document).ready(function()
    {
        $("#categoryTable").DataTable();  //-----------> JQUERY DATATABLE
    })
</script>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    
    $(document).ready(function()
    {
        //=============== DELETE REQUEST =============//

        $(".del").click(function()
        {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            let id = $(this).attr("value");
            
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => 
                    {
                    if (willDelete) 
                    {
                        $.ajax({
                            url:'/discount/delete/'+id,
                            type:'delete',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            success:function(data)
                            {
                                console.log(data)
                                
                                swal({
                                    title: "Your data has been deleted!",
                                    text: "Done!",
                                    icon: "success",
                                    button: "OK",
                                }).then((value) => {
                                    if (value) 
                                    {
                                        window.location.href="{{ route('discount.index')}}"
                                    }
                                });

                            },
                            error:function(err)
                            {
                                console.log(err)
                            }
                        })
                        
                    } 
                    
                });
        });
    })
</script>