@extends('admin.layout.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Orders</h1>
            </div>
            <div class="col-sm-6 text-right">
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
                <table class="table table-hover text-nowrap" id="orderTable">
                    <thead>
                        <tr>
                            <th>Orders #</th>											
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Date Purchased</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="{{ route('order.details')}}">OR756374</a></td>
                            <td>Mohit Singh</td>
                            <td>example@example.com</td>
                            <td>12345678</td>
                            <td>
                                <span class="badge bg-success">Delivered</span>
                            </td>
                            <td>$400</td>
                            <td>Nov 20, 2022</td>																				
                        </tr>
                    </tbody>
                </table>										
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> 
<script>
    $(document).ready(function()
    {
        $("#orderTable").DataTable();
    })
</script>
@endsection