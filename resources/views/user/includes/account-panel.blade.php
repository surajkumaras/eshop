<ul id="account-panel" class="nav nav-pills flex-column" >
    <li class="nav-item">
        <a href="{{ route('user.account')}}"  class="nav-link font-weight-bold" role="tab" aria-controls="tab-login" aria-expanded="false"><i class="fas fa-user-alt"></i> My Profile</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.order')}}"  class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i class="fas fa-shopping-bag"></i>My Orders</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('wishlist.show')}}"  class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i class="fas fa-heart"></i> Wishlist</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.password')}}"  class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i class="fas fa-lock"></i> Change Password</a>
    </li>
    <li class="nav-item">
        <a href="javascript:void(0)" id="logout1" class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </li>
</ul>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	$(document).ready(function()
	{
        $("#logout1").click(function()
		{
			swal({
					title: "Are you sure?",
					text: "You want to logout!",
					icon: "info",
					buttons: true,
					dangerMode: true,
					})
					.then((willDelete) => {
					if (willDelete) 
					{
						window.location.href="{{ route('user.logout')}}";
					} 
					else 
					{
						
					}
				});
		})
	})
</script>