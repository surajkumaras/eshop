<footer class="bg-dark mt-5">
	<div class="container pb-5 pt-3">
		<div class="row">
			<div class="col-md-4">
				<div class="footer-card">
					<h3>Get In Touch</h3>
					<p>E-Shop pvt ltd.<br>
					 S.C.O 15-16, Sector 45, Chandigarh, INDIA <br>
					suraj.enact@gmail.com <br>
					000 000 0000</p>
				</div>
			</div>

			<div class="col-md-4">
				<div class="footer-card">
					<h3>Important Links</h3>
					<ul>
						<li><a href="about-us.php" title="About">About</a></li>
						<li><a href="contact-us.php" title="Contact Us">Contact Us</a></li>						
						<li><a href="#" title="Privacy">Privacy</a></li>
						<li><a href="#" title="Privacy">Terms & Conditions</a></li>
						<li><a href="#" title="Privacy">Refund Policy</a></li>
					</ul>
				</div>
			</div>

			<div class="col-md-4">
				<div class="footer-card">
					<h3>My Account</h3>
					<ul>
						@if(!auth()->user())
						<li><a href="{{ route('user.login')}}" title="Sell">Login</a></li>
						<li><a href="{{ route('user.register')}}" title="Advertise">Register</a></li>
						@else
						<li><a href="{{ route('user.order')}}" title="Contact Us">My Orders</a></li>
						<li><a href="{{ route('user.account')}}" title="Contact Us">My Profile</a></li>	
						@endif					
					</ul>
				</div>
			</div>			
		</div>
	</div>
	<div class="copyright-area">
		<div class="container">
			<div class="row">
				<div class="col-12 mt-3">
					<div class="copy-right text-center">
						<p>© Copyright 2023-24 eShop. All Rights Reserved</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<script src="{{ asset('user-assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('user-assets/js/bootstrap.bundle.5.1.3.min.js')}}"></script>
<script src="{{ asset('user-assets/js/instantpages.5.1.0.min.js')}}"></script>
<script src="{{ asset('user-assets/js/lazyload.17.6.0.min.js')}}"></script>
<script src="{{ asset('user-assets/js/slick.min.js')}}"></script>
<script src="{{ asset('user-assets/js/custom.js')}}"></script>
<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>
</body>
</html>
