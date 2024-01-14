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

    <section class=" section-11 ">
        <div class="container  mt-5">
            <div class="row">
                <div class="col-md-3">
                    @include('user.includes.account-panel')
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Change Password</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="mb-3">               
                                    <label for="name">Old Password</label>
                                    <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control">
                                </div>
                                <div class="mb-3">               
                                    <label for="name">New Password</label>
                                    <input type="password" name="password" id="password" placeholder="New Password" class="form-control">
                                </div>
                                <div class="mb-3">               
                                    <label for="name">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="confirm_password" placeholder="Old Password" class="form-control">
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-dark" id="passUpdate">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(document).ready(function()
    {
        $('#passUpdate').click(function()
        {
            let old_pass = $('#old_password').val();
            let new_pass = $('#password').val();
            let con_pass = $('#confirm_password').val();


            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                            headers: {'X-CSRF-TOKEN': csrfToken}
                        });
            $.ajax({
                url:"{{ route('user.password.update')}}",
                method:'post',
                data:{old_pass:old_pass,password:new_pass,password_confirmation:con_pass},
                dataType:'json',
                success:function(data)
                {
                    if(data.code == 200)
                    {
                        toastr.options = 
                        {
                            "closeButton":true,
                            "progressBar":true
                        }
                        toastr.success(data.msg)
                    }

                    if(data.code == 422)
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
                    alert(err);
                }
            })
        })
    })
</script>
@endsection