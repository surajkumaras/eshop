@extends('user.layout.app')

@section('main')
<meta name="csrf-token" content="{{ csrf_token() }}">
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="#">Shop</a></li>
                    <li class="breadcrumb-item">Cart</li>
                </ol>
            </div>
        </div>
    </section>
    @if (!count($items) > 0)
        <h2 id="txt"><center>Your e-Cart is empty !</center></h2>
        <center><img src="{{ asset('img/empty-cart.png')}}" alt="" style="width:20%;height:50%;"> </center>
    @else
    <section class=" section-9 pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table" id="cart">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($items)
                                @php
                                    $total = 0;
                                @endphp
                                    @foreach ($items as $item)
                                        
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-left">
                                                    <img src="{{ asset('img/products/'.$item->img)}}" width="" height="">
                                                    <h2>{{ $item->name}}</h2>
                                                </div>
                                            </td>
                                            <td><i class='fas fa-rupee-sign' style='font-size:15px'></i> {{ number_format($item->price)}}</td>
                                            @php
                                                $total += $item->price;
                                            @endphp
                                            <td>
                                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1"  onclick="decrementQuantity({{$item->id}})">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" class="form-control form-control-sm  border-0 text-center" value="{{ $item->qnty }}" id="qty_{{$item->id}}">
                                                    <input type="hidden" name="stock" value="{{ $item->stock}}" id="stock_{{$item->id}}">
                                                    <input type="hidden" name="originalPrice" value="{{ $item->price}}" id="originalPrice_{{$item->id}}">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-sm btn-dark btn-plus p-2 pt-1 pb-1"  onclick="incrementQuantity({{$item->id}})">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p id="total_{{$item->id}}">{{ number_format($item->price)}}</p>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger" onclick="del({{$item->id}})"><i class="fa fa-times"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">            
                    <div class="card cart-summery">
                        <div class="sub-title">
                            <h2 class="bg-white">Cart Summery</h3>
                        </div> 
                        <div class="card-body">
                                <div class="d-flex justify-content-between pb-2">
                                    <div>Subtotal</div>
                                    <div><i class='fas fa-rupee-sign' style='font-size:17px'></i> {{ number_format($total) }}</div>
                                </div>
                                <div class="d-flex justify-content-between pb-2">
                                    <div>Shipping</div>
                                    <div><i class='fas fa-rupee-sign' style='font-size:17px'></i> 20</div>
                                </div>
                                <div class="d-flex justify-content-between summery-end">
                                    <div>Total</div>
                                    <div><i class='fas fa-rupee-sign' style='font-size:24px'></i> {{ number_format($total+20)}}</div>
                                </div>
                                <div class="pt-5">
                                    <a href="{{ route('checkout')}}" class="btn-dark btn btn-block w-100">Proceed to Checkout</a>
                                </div>
                        </div>
                    </div>     
                    <div class="input-group apply-coupan mt-4">
                        <input type="text" placeholder="Coupon Code" class="form-control">
                        <button class="btn btn-dark" type="button" id="button-addon2">Apply Coupon</button>
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

    //====================== DELETE FUNCTION ======================//
    function del(id)
    {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({   headers: {'X-CSRF-TOKEN': csrfToken} });
        $.ajax({
            url:'/cart/delete/'+id,
            method:'delete',
            data:{id:id},
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

    //================== INCREMENT QTY FUNCTION ===============//
    function incrementQuantity(itemId) 
    {
        var totalPriceElement = $('#total_' + itemId);
        let originalPrice = $('#originalPrice_'+itemId).val();

        var quantityInput = $('#qty_' + itemId);
        var currentQuantity = parseInt(quantityInput.val());

        let totalStock = $('#stock_'+itemId).val();
        if (currentQuantity < totalStock) 
        {
            quantityInput.val(currentQuantity + 1);
            let newTotalPrice = (currentQuantity+1) * originalPrice;

            totalPriceElement.text(newTotalPrice);
        }
        else 
        {
            toastr.options = 
                    {
                        "closeButton":true,
                        "progressBar":true
                    }
                    toastr.error("Out of Stock")
        }
    }

    //================== DECREMENT QTY FUNCTION =============//
    function decrementQuantity(itemId) 
    {
        var totalPriceElement = $('#total_' + itemId);
        let originalPrice = $('#originalPrice_'+itemId).val();

        var quantityInput = $('#qty_' + itemId);
        var currentQuantity = parseInt(quantityInput.val());
        
        if (currentQuantity > 1) 
        {
            let TotalCurrentitemPrice = totalPriceElement.text();
            let newTotalPrice = parseInt(TotalCurrentitemPrice) - parseInt(originalPrice);
            quantityInput.val(currentQuantity - 1);

            totalPriceElement.text(newTotalPrice);
        }
    }
</script>
@endsection