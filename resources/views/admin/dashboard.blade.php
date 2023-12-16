@extends('admin.layout.app')

@section('content')
	<!-- Content Header (Page header) -->
	<section class="content-header">					
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Dashboard</h1>
				</div>
				<div class="col-sm-6">
					
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-4 col-6">							
					<div class="small-box card">
						<div class="inner">
							<h3>150</h3>
							<p>Total Orders</p>
						</div>
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
						<a href="#" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				
				<div class="col-lg-4 col-6">							
					<div class="small-box card">
						<div class="inner">
							<h3 id="tcustomer">0</h3>
							<p>Total Customers</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="#" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				
				<div class="col-lg-4 col-6">							
					<div class="small-box card">
						<div class="inner">
							<h3>1000</h3>
							<p>Total Sale</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
						<a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
					</div>
				</div>
			</div>
		</div>					
		<!-- /.card -->
	</section>
	<!-- /.content -->

	<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script>
	$(document).ready(function()
	{
		//========== COUNT USERS ===========//
		$.ajax({
			url:'{{ route('status')}}',
			method:'get',
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$('#tcustomer').html(data.data);
			},
			error:function(err)
			{
				console.log(err);
			}
		});

		//=========== ADMIN PROFILE ===========//
		$.ajax({
			url:'{{ route('admin.profile')}}',
			method:'get',
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$("#uname").html(data.data.name);
				$("#uemail").html(data.data.email);
			},
			error:function(err)
			{
				console.log(err);
			}
		})
	});
</script>
@endsection
