@extends('user.layout.app')
@section('main')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('home')}}">Home</a></li>
                    <li class="breadcrumb-item">Register</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-10">
        <div class="container">
            <div class="login-form">    
                <form action="{{ route('user.register.new')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h4 class="modal-title">Register Now</h4>
                    <div class="form-group">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name')}}" placeholder="Name" id="name" name="name">
                        @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email')}}" placeholder="Email" id="email" name="email">
                        @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone')}}" placeholder="Phone" id="phone" name="phone">
                        @error('phone')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        
                        <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                            <option value="0">Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        @error('gender')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control @error('phone') is-invalid @enderror"  id="img" name="img">
                        @error('img')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control @error('password') is-invalid @enderror" value="{{ old('password')}}" placeholder="Password" id="password" name="password">
                        @error('password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" value="{{ old('password_confirmation')}}" id="password_confirmation" name="password_confirmation">
                    </div>
                    <div class="form-group small">
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div> 
                    <button type="submit" class="btn btn-dark btn-block btn-lg" value="Register">Register</button>
                </form>			
                <div class="text-center small">Already have an account? <a href="{{ route('user.login')}}">Login Now</a></div>
            </div>
        </div>
    </section>
</main>

@endsection