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
                    <li class="breadcrumb-item">Checkout</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-9 pt-4">
        <div class="container">
            <form id="payment_form" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="sub-title">
                            <h2>Shipping Address</h2>
                        </div>
                        <div class="card shadow-lg border-0">
                            <div class="card-body checkout-form">
                                <div class="row">
                                    @if ($user)
                                        
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" value="{{ $user->name}}" name="full_name" id="first_name" class="form-control" placeholder="Enter Name">
                                        </div>            
                                    </div>
                                    
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" value="{{ $user->email}}" name="email" id="email" class="form-control" placeholder="Email">
                                        </div>            
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" value="{{ $user->phone}}" name="mobile" id="mobile" class="form-control" placeholder="Mobile No.">
                                        </div>            
                                    </div>

                                    

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <textarea name="address"  id="address" cols="30" rows="3" placeholder="Address" class="form-control">{{ $user->address->adress }}</textarea>
                                        </div>            
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="appartment" id="appartment" class="form-control" placeholder="Near by, street no. or name, landmark (optional)">
                                        </div>            
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <select name="country" id="country" class="form-control">
                                                <option value="">Select a Country</option>
                                                <option value="india">India</option>
                                                <option value="nepal">Nepal</option>
                                                <option value="bangladesh">Bangladesh</option>
                                            </select>
                                        </div>            
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input type="text" name="state" id="state" class="form-control" placeholder="State">
                                        </div>            
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input type="text" value="{{ $user->address->city }}" name="city" id="city" class="form-control" placeholder="City">
                                        </div>            
                                    </div>

                                    
                                    
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input type="text" value="{{ $user->address->pin_code}}" name="zip" id="zip" class="form-control" placeholder="Zip">
                                        </div>            
                                    </div>

                                    
                                    

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <textarea name="order_notes" id="order_notes" cols="30" rows="2" placeholder="Order Notes (optional)" class="form-control"></textarea>
                                        </div>            
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="col-md-4">
                        <div class="sub-title">
                            <h2>Order Summery</h3>
                        </div>                    
                        <div class="card cart-summery">
                            <div class="card-body">
                                @if ($items)
                                    @php
                                        $total = 0;
                                        $i = 1;
                                    @endphp
                                    
                                    @foreach ($items as $item )
                                        <div class="d-flex justify-content-between pb-2">
                                            <div class="h6">{{$i}}. {{ $item->name}} x {{ $item->qnty}}</div>
                                            <div class="h6">{{ number_format($item->price * $item->qnty)}}</div>
                                                @php
                                                    $total += $item->price;
                                                    $i += 1;
                                                @endphp
                                        </div>
                                    @endforeach
                                @endif
                                        
                                    
                                <div class="d-flex justify-content-between summery-end">
                                    <div class="h6"><strong>Subtotal</strong></div>
                                    <div class="h6"><strong><i class='fas fa-rupee-sign' style='font-size:15px'></i> {{ number_format($totalAmount) }}</strong></div>
                                </div>
                                <div class="d-flex justify-content-between summery-end">
                                    <div class="h6"><strong>GST 18%</strong></div>
                                    <div class="h6"><strong><i class='fas fa-rupee-sign' style='font-size:15px'></i> {{ number_format($totalAmount * 18 / 100) }}</strong></div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div class="h6"><strong>Shipping</strong></div>
                                    <div class="h6"><strong><i class='fas fa-rupee-sign' style='font-size:15px'></i> 20</strong></div>
                                </div>
                                <div class="d-flex justify-content-between mt-2 summery-end">
                                    <div class="h5"><strong>Total</strong></div>
                                    <div class="h5"><strong><i class='fas fa-rupee-sign' style='font-size:20px'></i> {{ number_format($totalAmount+20+ ($totalAmount * 18 / 100)) }}</strong></div>
                                </div>                            
                            </div>
                        </div>   
                        
                        <div class="card payment-form ">     
                            <h3 class="card-title h5 mb-3"><i class='fas fa-money-check' style='font-size:36px'></i>  Payment Method </h3>
                            <div >
                                <input checked type="radio" name="payment_method" id="payment_method_1" value="cod" >
                                <label for="payment_method_1" class="form-check-label">COD</label>
                            </div>
                            <div>
                                <input  type="radio" name="payment_method" id="payment_method_2" value="cod" >
                                <label for="payment_method_2" class="form-check-label">Debit Card</label>
                            </div>
                            
                            <div class="card-body p-0 d-none mt-3" id="card-payment-form">
                                
                                <div class="mb-3">
                                    <label for="card_number" class="mb-2">Card Number</label>
                                    <input type="text" name="card_number" id="card_number" placeholder="Valid Card Number" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="expiry_date" class="mb-2">Expiry Date</label>
                                        <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YYYY" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="expiry_date" class="mb-2">CVV Code</label>
                                        <input type="text" name="expiry_date" id="expiry_date" placeholder="123" class="form-control">
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="pt-4">
                                <button type="submit" class="btn-dark btn btn-block w-100">Pay Now</button>
                            </div>
                        </div>

                            
                        <!-- CREDIT CARD FORM ENDS HERE -->
                        
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script> 
    $("#payment_method_1").click(function()
    {
        if($(this).is(":checked") == true)
        {
            $("#card-payment-form").addClass('d-none');
            // $("#card-payment-form").removeClass('d-none');
        }
    })

    $("#payment_method_2").click(function()
    {
        if($(this).is(":checked") == true)
        {
           // $("#card-payment-form").addClass('d-none');
            $("#card-payment-form").removeClass('d-none');
        }
    })

    $("#payment_form").submit(function(e)
    {
        e.preventDefault();

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': csrfToken}
                    });
       
        $.ajax({
            url:"{{ route('checkout.payment')}}",
            type:'post',
            data:$("#payment_form").serialize(),
            dataType:'json',
            success:function(response)
            {
                if(response.status == 'success')
                {
                    toastr.success(response.message,"Order ID:"+ response.order_id);
                    
                    setTimeout(() => {
                        window.location.href = "{{ route('home')}}";
                    }, 3000);
                }
            },
            error:function(err)
            {
                console.error(err);
            }
        })
    })
</script>
@endsection