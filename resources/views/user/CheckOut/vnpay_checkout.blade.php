@extends('welcome')
@section('contend') 

@php
	$total=0;
	$total_dis=0;
	$total_org = 0;
	$cart=Session::get('cart');
@endphp
@foreach($cart as $key => $value)  
	@php
	$total=$total+ $value['product_price']*$value['product_qty']*(1-$value['product_discount']);
	$total_dis=$total_dis+ $value['product_price']*$value['product_qty']*$value['product_discount'];
	@endphp	
@endforeach
@php
	$total_org = $total;
@endphp

@if(session()->has('coupon_id'))
	@php
		$type = Session::get('coupon_type');
		$price= Session::get('coupon_price');
		if($type==1){
			$total = $total - $total*($price/100);
			$total_dis = $total_dis + $total*($price/100);
		}elseif($type==2){
			$total = $total - $price;
			$total_dis = $total_dis + $price;
		}
	@endphp	
@endif

@php
//Total chưa cộng phí vận chuyển
if($total<1000000){
	$total=$total+30000;
}
@endphp

<div class="ogami-breadcrumb">
	<div class="container">
		<ul>
			<li> <a class="breadcrumb-link" href="{{URL::to('/home')}}"> <i class="fas fa-home"></i>Trang Chủ</a></li>
			<li> <a class="breadcrumb-link" href="{{URL::to('/cart_shopping')}}">Giỏ Hàng Của Bạn</a></li>
			<li> <a class="breadcrumb-link active" href="">Thanh Toán</a></li>
		</ul>
	</div>
</div>
<div class="order-step">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="order-step_block">
					<div class="row no-gutters">
						<div class="col-12 col-md-4">
							<div class="step-block">
								<div class="step">
									<h2>Giỏ Hàng</h2><span>01</span>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="step-block active">
								<div class="step">
									<h2>Thanh Toán</h2><span>02</span>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="step-block">
								<div class="step">
									<h2>Hoàn Tất</h2><span>03</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	$user_id=Session::get('user_id');
?>
<!-- End order step-->
<div class="shop-checkout">
	<div class="container">
		<div class="row">
			@if(session('notice'))
			<p style="color: black; text-align: center;">
				{{session('notice')}}
			</p>
			@endif
			<div class="col-12 col-lg-8">
				<form action="{{URL::to('/vnpay_payment')}}" method="post">	
					{{csrf_field()}}
					<input type="hidden" name="Total" value="{{$total}}">
					<h2 class="form-title">THÔNG TIN ĐƠN HÀNG</h2>
					<div class="form-group">
						<label for="inputCountry">Địa Chỉ Nhận Hàng*</label>
						<select class="no-round-input-bg" id="Address" name="DiaChi" required>
							@foreach($all_address_by_id as $key => $value)
							<option value="{{$value->MaDC}}">{{$value->HoTen}} - {{$value->SDT}} - {{$value->DiaChi}}</option>
							@endforeach
						</select>
					</div>
					<input type="hidden" name="PhuongThuc" id="paymethod" value="Thanh Toán Bằng VnPay">
					<div class="form-group">
						<label for="inputNote">Ghi Chú</label>
						<textarea class="textarea-form-bg" id="inputNote" name="GhiChu" cols="30" rows="7" style="resize: none;"></textarea>
					</div>
					<div class="form-group">
						<input type="checkbox" name="check" required>
						<label>Tôi đồng ý với các điều khoản.</label>
					</div>
					<h2 class="form-title">Phương thức thanh toán</h2>
					<input type="submit" class="normal-btn" name="redirect" id="redirect" value="THANH TOÁN VNPAY" <?php if($user_id==null) echo "disabled" ?>>
				</form>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<h2 class="form-title">Đơn Hàng Của Bạn</h2>
				<div class="shopping-cart">
					<div class="cart-total_block">
						<table class="table">
							<colgroup>
								<col span="1" style="width: 50%">
								<col span="1" style="width: 50%">
							</colgroup>
							<tbody>
								@if($cart)        

								@foreach($cart as $key => $value)  
								<tr>
									<th class="name">{{$value['product_name']}} × <span>{{$value['product_qty']}}</span></th>
									<td class="price black" style="border-top: 0">{{number_format($value['product_qty']*$value['product_price'] , 0, ',', ' ').'đ';}}</td>
								</tr>
								@endforeach  
								<tr>
									<th>TỔNG TIỀN</th>
									<td class="price">{{number_format($total_org , 0, ',', ' ').'đ';}}</td>
								</tr>
								<tr>
									<th>SỐ TIỀN ĐÃ GIẢM</th>
									<td class="price">{{number_format($total_dis , 0, ',', ' ').'đ';}}</td>
								</tr>
								<tr>
									<th>PHÍ VẬN CHUYỂN</th>
									<td>
										@php
										if($total>=1000000){
											echo '<p>Miễn Phí Giao Hàng</p>';
										}else{
											echo number_format(30000 , 0, ',', ' ').'đ';
										}
										@endphp
									</td>
								</tr>
								<tr>
									<th>THÀNH TIỀN</th>
									<td class="total">{{number_format($total , 0, ',', ' ').'đ';}}</td>
								</tr>
								@endif 	
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection