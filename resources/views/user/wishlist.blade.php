@extends('user.layout.app')

@section('main')

<meta name="csrf-token" content="{{ csrf_token() }}">
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                    <li class="breadcrumb-item">Settings</li>
                </ol>
            </div>
        </div>
    </section>
    @if(!count($items)>0)
                            
        <center><img src="{{ asset('img/wishlist.png')}}" alt="" style="width:20%;height:50%;"> </center>
    @else
    <section class=" section-11 ">
        <div class="container  mt-5">
            <div class="row">
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">My Wishlist</h2>
                        </div>
                        
                        <div class="card-body p-4">
                            @if ($items)
                                @foreach ($items as $item )
                                    <div class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom">
                                        <div class="d-block d-sm-flex align-items-start text-center text-sm-start">
                                            <a class="d-block flex-shrink-0 mx-auto me-sm-4" href="#" style="width: 10rem;">
                                                <img src="{{ asset('img/products/'.$item->img)}}" alt="Product"></a>
                                            <div class="pt-2">
                                                <h3 class="product-title fs-base mb-2"><a href="shop-single-v1.html">{{ $item->name}}</a></h3>                                        
                                                <div class="fs-lg text-accent pt-2">{{ number_format($item->price)}}</div>
                                            </div>
                                        </div>
                                        {{-- <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                            <button class="btn btn-outline-danger btn-sm" type="button" onclick="removeItem({{$item->product_id}})"><i class="fas fa-trash-alt me-2"></i>Remove</button>
                                        </div> --}}

                                        <div class="product-action">
                                                                        
                                        </div>
                                        <div class="product-action">
                                            <a class="btn btn-danger" href="javascript:void(0)" onclick="removeItem({{$item->product_id}})">
                                                <i class="fas fa-trash-alt me-2"></i> Remove
                                            </a>
                                            <a class="btn btn-info" href="javascript:void(0)" onclick="addToCart({{ $item->product_id}})">
                                                <i class="fa fa-shopping-cart"></i> Add To Cart
                                            </a>                            
                                        </div>
                                    </div>  
                                @endforeach
                            @endif
                        </div>
                            
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
</main>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    function removeItem(id)
    {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': csrfToken}
                    });
        $.ajax({
            url:'{{ route('wishlist.delete')}}',
            method:'post',
            data:{product_id:id},
            dataType:'json',
            success:function(data)
            {
                if(data.code == 200)
                {
                    location.reload();
                }

                
            },
            error:function(err)
            {
                console.log(err);
            }
        })
    }

    function addToCart(id)
    {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': csrfToken}
                    });
        $.ajax({
            url:'{{ route('cart.add')}}',
            method: 'post',
            data:{product_id:id},
            dataType:'json',
            success:function(data)
            {
                console.log(data)
                if(data.status == true)
                {
                    toastr.options = 
                    {
                        "closeButton":true,
                        "progressBar":true
                    }
                    toastr.success("Item added to your cart")
                }

                if(data.status == false && data.code == 500)
                {
                    toastr.options = 
                    {
                        "closeButton":true,
                        "progressBar":true
                    }
                    toastr.error(data.msg)
                }
            },
            error:function(err)
            {
                console.log(err)
            }
        })

    }

    
</script>
@endsection