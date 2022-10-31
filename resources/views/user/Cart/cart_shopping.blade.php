@extends('welcome')
@section('contend')  

<div class="ogami-breadcrumb">
	<div class="container">
		<ul>
			<li> <a class="breadcrumb-link" href="{{URL::to('/home')}}"> <i class="fas fa-home"></i>Trang Chủ</a></li>
			<li> <a class="breadcrumb-link active" href="{{URL::to('/cart_shopping')}}">Giỏ hàng của bạn</a></li>
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
							<div class="step-block active">
								<div class="step">
									<h2>Giỏ Hàng</h2><span>01</span>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="step-block">
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
<!-- End order step-->
<div class="shopping-cart">
	<div class="container">
		
		<div class="row">
			<div class="col-12">
				<div class="product-table">
					<table class="table table-responsive"> 
						<colgroup>
							<col span="1" style="width: 15%">
							<col span="1" style="width: 30%">
							<col span="1" style="width: 15%">
							<col span="1" style="width: 15%">
							<col span="1" style="width: 15%">
							<col span="1" style="width: 10%">
						</colgroup>
						<thead>
							<tr>
								<th class="product-iamge" scope="col">Hình Ảnh</th>
								<th class="product-name" scope="col">Tên Sản Phẩm</th>
								<th class="product-price" scope="col">Giá</th>
								<th class="product-quantity" scope="col">Số Lượng</th>
								<th class="product-total" scope="col">Thành Tiền</th>
								<th class="product-clear" scope="col"> 
									<button class="no-round-btn"><i class="icon_close"></i></button>
								</th>
							</tr>
						</thead>
						<tbody>
						@php
							$total=0;
							$cart=Session::get('cart');
						@endphp

						@if($cart)        

							@foreach($cart as $key => $value)  
							@php
							$total=$total+ $value['product_price']*$value['product_qty']*(1-$value['product_discount']);
							@endphp
							<form>
								{{csrf_field() }}
							<tr>
								<td class="product-iamge"> 
									<div class="img-wrapper"><img src="{{URL::to('public/upload/'.$value['product_image'])}}" alt="product image"></div>
								</td>
								<td class="product-name">{{$value['product_name']}}</td>
								<td class="product-price">{{number_format($value['product_price'] , 0, ',', ' ').'đ';}}</td>
								<td class="product-quantity"> 
									<input class="cart-quantity quantity no-round-input" type="number" min="1" value="{{$value['product_qty']}}" data-id="{{$value['session_id']}}" name="quantity[{{$value['session_id']}}]" id="quantity_{{$value['session_id']}}">
								</td>
								<td class="product-total">
									{{number_format($value['product_price']*$value['product_qty']*(1-$value['product_discount']) , 0, ',', ' ').'đ';}}
								</td>
								<td class="product-clear"> 
									<a href="{{URL::to('/delete_cart/'.$value['session_id'])}}" class="normal-btn"><i class="icon_close"></i></a>
								</td>
							</tr>
						</form>
							@endforeach  
						@else
							<tr>
								<td>Không có sản phẩm trong giỏ hàng</td>
							</tr>
						@endif   
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-12 col-sm-4 text-left">
				{{-- <button class="no-round-btn black cart-update">Cập Nhật</button> --}}
			</div>
			<div class="col-12 col-sm-8"></div>
		</div>
		
		<div class="row justify-content-end">
			<div class="col-12 col-md-6 col-lg-6">
				<div class="cart-total_block">
					<table class="table">
						<colgroup>
							<col span="1" style="width: 50%">
							<col span="1" style="width: 50%">
						</colgroup>
						<tbody>
							<tr>
								<th>TỔNG TIỀN HÀNG</th>
								<td>{{number_format($total , 0, ',', ' ').'đ';}}</td>
							</tr>
							<tr>
								<th>PHÍ VẬN CHUYỂN</th>
								<td>
									@php
									if($total>=1000000){
										echo '<p>Miễn Phí</p>';
									}elseif ($total==0) {
										echo 0;
									}
									else{
										$total=$total+30000;
										echo number_format(30000 , 0, ',', ' ').'đ';
									}
									@endphp
								</td>
							</tr>
							<tr>
								<th>TỔNG THANH TOÁN</th>
								<td>{{number_format($total , 0, ',', ' ').'đ';}}</td>
							</tr>
						</tbody>
					</table>
					<div class="row">
						<div class="col-12 justify-content-center align-items-center text-center">
							<a href="{{URL::to('/check_out')}}" class="normal-btn" style="margin-bottom: 10px;">THANH TOÁN</a>
							<div class="checkout-method">
								<span>- Hoặc -</span>
								<a href="{{URL::to('/vnpay_check_out')}}">
								THANH TOÁN VNPAY
								</a>
								{{-- <a href="{{URL::to('/momo_check_out')}}">
								<img src="{{asset('public/frontend/assets/images/MoMo-Logo.png')}}" alt="" style="width: 30%">
								</a> --}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection      