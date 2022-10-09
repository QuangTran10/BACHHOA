@extends('shipper_layout')

@section('shipper_header')

<div class="navbar">
	<div class="container">
		<div class="row">
			<div class="col s9">
				<div class="content-left">
					<a href="{{URL::to('/dashboard_shipper')}}"><h1><span>E</span>xpress</h1></a>
				</div>
			</div>
			<div class="col s3">
				<div class="content-right">
					<a href="#slide-out" data-activates="slide-out" class="sidebar"><i class="fa fa-bars"></i></a>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('shipper_content')

<div class="segments-page">
	<div class="container">
		<div class="settings">
			<div class="pages-title">
				<h3>Thông Tin Cá Nhân</h3>
				<div class="line"></div>
			</div>
			<form>
				<input type="text" name="HoTenGH" placeholder="Họ và Tên" value="{{$shipper->HoTenGH}}">
				<div class="row" style="margin-left: 0px;">
					<div class="input-field col s7">
						<select class="City">
							<option value="" disabled selected>Thành Phố</option>
							@foreach($city as $value)
								@if($shipper->ThanhPho == $value->matp)
									<option value="{{$value->matp}}" selected >{{$value->name}}</option>
								@else
									<option value="{{$value->matp}}">{{$value->name}}</option>
								@endif
							@endforeach
						</select>
					</div>
					<div class="col s5">
						<h5>Giới Tính</h5>
						<p style="float: left;">
							<label>
								<input value="1" name="GioiTinh" type="radio" {{ ($shipper->GioiTinh==1)? "checked" : "" }}/>
								<span>Nam</span>
							</label>
						</p>
						<p >
							<label>
								<input value="0" name="GioiTinh" type="radio" {{ ($shipper->GioiTinh==0)? "checked" : "" }}/>
								<span>Nữ</span>
							</label>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col s6">
						<input type="text" name="SDT" placeholder="Số điện thoại" value="{{$shipper->SDT}}">
					</div>
					<div class="col s6">
						<input type="email" name="Email" placeholder="Email" value="{{$shipper->Email}}">
					</div>
				</div>
				<input type="text" name="DiaChi" placeholder="Địa chỉ cụ thể" value="{{$shipper->DiaChi}}">
				<button class="button">Lưu Thay Đổi</button>
			</form>
		</div>
	</div>
</div>



@endsection	