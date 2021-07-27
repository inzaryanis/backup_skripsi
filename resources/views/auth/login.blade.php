<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('auth/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('auth/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('auth/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('auth/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('auth/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('auth/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('auth/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('auth/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('auth/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('auth/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body style="background-color: #FFABAB;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
                <form class="login100-form validate-form" method="POST" action="/postlogin" autocomplete="off"> 
                @csrf
					<span class="login100-form-title p-b-43">
					<img src="{{asset('auth/images/logo_db.png')}}" alt="navbar brand" class="navbar-brand" height="90px" width="160px">
					</span>
					
					
					<div class="wrap-input100 validate-input" data-validate = "Valid username is required: ex@abc.xyz">
						<input class="input100" type="text" name="username">
						<span class="focus-input100"></span>
						<span class="label-input100">username</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
					
					<!-- <a class="btn btn-default" href="/register">Register</a> -->
				</form>

				<div class="login100-more" >
				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
		  <div class="carousel-item active">
			<img class="d-block w-100" src="{{asset('auth/images/bg_login_revisi.png')}}" height="800" width="1000"alt="First slide" >
		  </div>
		  <div class="carousel-item">
			<img class="d-block w-100" src="{{asset('auth/images/customer support.png')}}" height="800" width="1000" alt="Second slide" >
		  </div>
		  <div class="carousel-item">
			<img class="d-block w-100" src="{{asset('auth/images/complaint.png')}}" height="800" width="1000" alt="Third slide" >
		  </div>
		  <div class="carousel-item">
			<img class="d-block w-100" src="{{asset('auth/images/csis-4.png')}}" height="800" width="1000" alt="fourth slide" >
		  </div>
		  <div class="carousel-item">
			<img class="d-block w-100" src="{{asset('auth/images/csis-5.png')}}" height="800" width="1000" alt="fifth slide" >
		  </div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
		  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		  <span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
		  <span class="carousel-control-next-icon" aria-hidden="true"></span>
		  <span class="sr-only">Next</span>
		</a>
	  </div>

  </div>
  <br>
  
  <!-- The dots/circles -->
  <div style="text-align:center">
	<span class="dot" onclick="currentSlide(1)"></span>
	<span class="dot" onclick="currentSlide(2)"></span>
	<span class="dot" onclick="currentSlide(3)"></span>
	<span class="dot" onclick="currentSlide(4)"></span>
	<span class="dot" onclick="currentSlide(5)"></span>
  </div>
				</div>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="{{asset('auth/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('auth/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('auth/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('auth/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('auth/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('auth/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('auth/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('auth/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('auth/js/main.js')}}"></script>

</body>
</html>