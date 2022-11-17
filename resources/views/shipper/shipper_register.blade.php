<!DOCTYPE html>
<html lang="zxx">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="{{asset('public/backend/shipper/images/shipping_icon.png')}}">
	<title>Express</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	{{-- <link rel="stylesheet" href="{{asset('public/backend/shipper/css/materialize.css')}}"> --}}
	<link rel="stylesheet" href="{{asset('public/backend/shipper/css/loaders.css')}}">
	<link rel="stylesheet" href="{{asset('public/backend/shipper/css/lightbox.css')}}">
	<link rel="stylesheet" href="{{asset('public/backend/shipper/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/backend/shipper/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/backend/shipper/css/owl.theme.default.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/backend/shipper/css/style.css')}}">

</head>
<body>
	
	<!-- navbar -->
	<div class="navbar">
		<div class="container">
			<div class="row">
				<div class="col s9">
					<div class="content-left">
						<a href=""><h1><span>E</span>xpress</h1></a>
					</div>
				</div>
				<div class="col s3"></div>
			</div>
		</div>
	</div>
	<!-- end navbar -->

	<!-- sign up -->
	<div class="sign-up segments-page">
		<div class="container">
		<div class="signup-contents">
			<div class="pages-title">
				<h3>Đăng Ký</h3>
				<div class="line"></div>
			</div>
			<form action="{{URL::to('/add_shipper')}}" method="post">
				{{csrf_field()}}
				<input type="text" name="HoTenGH" placeholder="Họ và Tên" required>
				<div class="row" style="margin-left: 0px;">
					<div class="input-field col s7">
						<select class="City" required>
							<option value="" disabled selected >Thành Phố</option>
							@foreach($city as $value)
							<option value="{{$value->matp}}">{{$value->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="col s5">
						<h5>Giới Tính</h5>
						<p style="float: left;">
							<label>
								<input value="1" name="GioiTinh" type="radio" required/>
								<span>Nam</span>
							</label>
						</p>
						<p >
							<label>
								<input value="0" name="GioiTinh" type="radio" required/>
								<span>Nữ</span>
							</label>
						</p>
					</div>
				</div>
				<input type="text" name="SDT" placeholder="Số điện thoại" required>
				<input type="text" name="DiaChi" placeholder="Địa chỉ cụ thể" required>
				<input type="email" name="Email" placeholder="Email" required>
				<input type="password" name="Password" placeholder="Mật Khẩu" id="password" required>
				<input type="password" placeholder="Nhập lại mật khẩu" id="repassword" required>
				<input type="hidden" name="ThanhPho" id="ThanhPho">

				<input type="submit" class="button btn-register" value="Đăng Ký">
				<a href="{{URL::to('/shipper')}}">Đăng Nhập</a>
			</form>
		</div>
		</div>
	</div>
	<!-- end sign up -->

	<script src="{{asset('public/backend/shipper/js/jquery.min.js')}}"></script>
	<script src="{{asset('public/backend/shipper/js/jquery.validate.min.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script src="{{asset('public/backend/shipper/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('public/backend/shipper/js/main.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('select').formSelect();

			$('.City').change(function(event) {
				var city = $('.City').val();

				$('#ThanhPho').val(city);
			});

		});
	</script>


</body>
</html>