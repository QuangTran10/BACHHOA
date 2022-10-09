<!DOCTYPE html>
<html lang="zxx">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="icon" href="{{asset('public/backend/shipper/images/shipping_icon.png')}}">
	<title>Express</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="{{asset('public/backend/shipper/css/materialize.css')}}">
	<link rel="stylesheet" href="{{asset('public/backend/shipper/css/loaders.css')}}">
	<link rel="stylesheet" href="{{asset('public/backend/shipper/css/lightbox.css')}}">
	<link rel="stylesheet" href="{{asset('public/backend/shipper/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/backend/shipper/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/backend/shipper/css/owl.theme.default.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/backend/shipper/css/style.css')}}">

</head>
<body>

	<div class="navbar">
		<div class="container">
			<div class="row">
				<div class="col s9">
					<div class="content-left">
						<a href="{{URL::to('/dashboard_shipper')}}"><h1><span>E</span>xpress</h1></a>
					</div>
				</div>
				<div class="col s3"></div>
			</div>
		</div>
	</div>

	<!-- sign in -->
	<div class="sign-in segments-page">
		<div class="container">
		<div class="signin-contents">
			<div class="pages-title">
				<h3>Đăng Nhập</h3>
				<div class="line"></div>
			</div>
			@if(session('notice'))
			<p style="color: black; text-align: center;">
				{{session('notice')}}
			</p>
			@endif
			<form action="{{URL::to('/login_shipper')}}" method="post">
				{{csrf_field()}}
				<input type="email" name="Email" placeholder="Email....">
				<input type="password" name="Password" placeholder="Mật khẩu....">

				<button class="button"><i class="fa fa-send"></i> Đăng Nhập</button>
				<a href="{{URL::to('/register_shipper')}}">Đăng Ký</a>
			</form>
		</div>
		</div>
	</div>
	<!-- end sign in -->

	<script src="{{asset('public/backend/shipper/js/jquery.min.js')}}"></script>
	<script src="{{asset('public/backend/shipper/js/materialize.js')}}"></script>
	<script src="{{asset('public/backend/shipper/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('public/backend/shipper/js/main.js')}}"></script>

</body>
</html>