<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Laravel Shop :: Administrative Panel</title>
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{ asset('css/adminlte.min.css')}}">
		<link rel="stylesheet" href="{{ asset('css/custom.css')}}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<!-- /.login-logo -->
			<div class="card card-outline card-primary">
			  	<div class="card-header text-center">
					<a href="#" class="h3">Administrative Panel</a>
			  	</div>

			  	<div class="card-body">
					<p class="login-box-msg"></p>
					<form action="{{ route('admin.auth')}}" method="post">
                        @csrf
				  		<div class="input-group mb-3">
							<input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
							<div class="input-group-append">
					  			<div class="input-group-text">
									<span class="fas fa-envelope"></span>
					  			</div>
							</div>
							@error('email')
								<p class="invalid-feedback">{{ $message}}</p>
							@enderror
				  		</div>
                          
                            
                        </span>
				  		<div class="input-group mb-3">
							<input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
							<div class="input-group-append">
					  			<div class="input-group-text">
									<span class="fas fa-lock"></span>
					  			</div>
							</div>
							@error('password')
                            <p class="invalid-feedback">{{ $message}}</p>
                        @enderror
				  		</div>
                          
                        
				  		<div class="row">
							<!-- <div class="col-8">
					  			<div class="icheck-primary">
									<input type="checkbox" id="remember">
									<label for="remember">
						  				Remember Me
									</label>
					  			</div>
							</div> -->
							<!-- /.col -->
							<div class="col-4">
					  			<button type="submit" class="btn btn-primary btn-block">Login</button>
							</div>
							<!-- /.col -->
				  		</div>
					</form>
		  			<p class="mb-1 mt-3">
				  		<a href="forgot-password.html">I forgot my password</a>
					</p>					
			  	</div>
			  	<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<!-- ./wrapper -->
		<!-- jQuery -->
		<script src="{{asset('css/custom.css')}}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{ asset('css/custom.css')}}"></script>
		<!-- AdminLTE App -->
		<script src="{{ asset('js/adminlte.min.js')}}"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="{{ asset('js/demo.js')}}"></script>
	</body>
</html>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	$(document).ready(function()
	{
		@if ($errors->has('login'))
			toastr.options = 
			{
				"closeButton":true,
				"progressBar":true
			}
			toastr.error("{{ $errors->first('login') }}")
		@endif
			
		@if ($errors->has('warn'))
			swal ( "Oops" ,  "{{ $errors->first('warn') }}" ,  "error" )
		@endif
	})
</script>