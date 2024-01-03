@extends('user.layout.app')

@section('main')
    
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
                                        <input type="text" value="{{ $user->name}}" name="first_name" id="first_name" class="form-control" placeholder="Enter Name">
                                    </div>            
                                </div>
                                
                                
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" value="{{ $user->email}}" name="email" id="email" class="form-control" placeholder="Email">
                                    </div>            
                                </div>

                                {{-- <div class="col-md-12">
                                    <div class="mb-3">
                                        <select name="country" id="country" class="form-control">
                                            <option value="">Select a Country</option>
                                            <option value="1">India</option>
                                            <option value="2">UK</option>
                                        </select>
                                    </div>            
                                </div> --}}

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

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" value="{{ $user->address->city }}" name="city" id="city" class="form-control" placeholder="City">
                                    </div>            
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" name="state" id="state" class="form-control" placeholder="State">
                                    </div>            
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" value="{{ $user->address->pin_code}}" name="zip" id="zip" class="form-control" placeholder="Zip">
                                    </div>            
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" value="{{ $user->phone}}" name="mobile" id="mobile" class="form-control" placeholder="Mobile No.">
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
                        <h3 class="card-title h5 mb-3"><i class='fas fa-money-check' style='font-size:36px'></i>  Payment Details </h3>
                        <div class="card-body p-0">
                            
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
                            <div class="pt-4">
                                <a href="#" class="btn-dark btn btn-block w-100">Pay Now</a>
                            </div>
                        </div>                        
                    </div>

                          
                    <!-- CREDIT CARD FORM ENDS HERE -->
                    
                </div>
            </div>
        </div>
    </section>
</main>

@endsection