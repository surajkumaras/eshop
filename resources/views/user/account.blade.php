@extends('user.layout.app')
@section('main')
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

    <section class=" section-11 ">
        <div class="container  mt-5">
            <div class="row">
                <div class="col-md-3">
                    @include('user.includes.account-panel')
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                @if ($user)
                                    
                                
                                <div class="mb-3">               
                                    <label for="name">Name</label>
                                    <input type="text" value="{{ $user->name}}" name="name" id="name" placeholder="Enter Your Name" class="form-control">
                                </div>
                                <div class="mb-3">            
                                    <label for="email">Email</label>
                                    <input type="text" value="{{ $user->email}}" name="email" id="email" placeholder="Enter Your Email" class="form-control">
                                </div>
                                <div class="mb-3">                                    
                                    <label for="phone">Phone</label>
                                    <input type="text" value="{{ $user->phone}}" name="phone" id="phone" placeholder="Enter Your Phone" class="form-control">
                                </div>

                                <div class="mb-3">                                    
                                    <label for="phone">Address</label>
                                    @if ($user->address)
                                        <textarea name="address"  id="address" class="form-control" cols="30" rows="5" placeholder="Enter Your Address"> {{ $user->address->adress}}</textarea>
                                    @else
                                        <textarea name="address"  id="address" class="form-control" cols="30" rows="5" placeholder="Enter Your Address"> Address</textarea>
                                    @endif
                                </div>
                                <div class="mb-3">                                    
                                    <label for="phone">City</label>
                                    <input type="text" value="{{ $user->city}}" name="city" id="city" placeholder="Enter Your City" class="form-control">
                                </div>
                                <div class="mb-3">                                    
                                    <label for="phone">Profile Image</label>
                                    <input type="file" name="img" id="img"  class="form-control">
                                </div>

                                <div class="d-flex">
                                    <button class="btn btn-dark">Update</button>
                                </div>

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection