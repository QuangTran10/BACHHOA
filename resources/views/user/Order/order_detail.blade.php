@extends('welcome')
@section('contend')  

<div class="ogami-breadcrumb">
	<div class="container">
		<ul>
			<li> <a class="breadcrumb-link" href="{{URL::to('/home')}}"> <i class="fas fa-home"></i>Trang Chủ</a></li>
			<li> <a class="breadcrumb-link active" href="{{URL::to('/show_order')}}">Đơn Hàng Của Tôi</a></li>
		</ul>
	</div>
</div> 

<div class="shopping-cart">
	<div class="container">
		<div class="row">
			<div class="col-12">
				@if(session('notice'))
				<p style="color: red; text-align: center;font-size: 18px;">
					{{session('notice')}}
				</p>
				@endif
				<div class="product-table">
					<table class="table table-responsive"> 
						<colgroup>
							<col span="1" style="width: 15%">
							<col span="1" style="width: 30%">
							<col span="1" style="width: 15%">
							<col span="1" style="width: 10%">
							<col span="1" style="width: 15%">
							<col span="1" style="width: 15%">
						</colgroup>
						<thead>
							<tr>
								<th class="product-iamge" scope="col">Hình Ảnh</th>
								<th class="product-name" scope="col">Tên Sản Phẩm</th>
								<th class="product-price" scope="col">Giá</th>
								<th class="product-clear" scope="col"></th>
								<th class="product-quantity" scope="col">Số Lượng</th>
								<th class="product-total" scope="col">Thành Tiền</th>
							</tr>
						</thead>
						<tbody>
						@php
							$total=0;
						@endphp

						@foreach($order_details as $key => $value)  
						@php
						$total=$total+ $value->SoLuong*$value->GiaDatHang*(1-$value->GiamGia);
						@endphp
						<tr>
							<td class="product-iamge"> 
								<div class="img-wrapper"><img src="{{URL::to('public/upload/'.$value->Image)}}" alt="product image"></div>
							</td>
							<td class="product-name">{{$value->TenSP}}</td>
							<td class="product-price">{{number_format($value->GiaDatHang , 0, ',', ' ').'đ';}}</td>
							<td class="product-clear"> 
								{{$value->GiamGia*100}}%
							</td>
							<td class="product-quantity"> 
								<input class="quantity no-round-input" type="number" min="1" value="{{$value->SoLuong}}">
							</td>
							<td class="product-total">
								{{number_format($value->SoLuong*$value->GiaDatHang*(1-$value->GiamGia) , 0, ',', ' ').'đ';}}
							</td>
						</tr>
						@endforeach    
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-12 col-sm-4 text-left">
				@if($order->TrangThai==0)
				<form action="{{URL::to('/update_order')}}" method="post">
					{{csrf_field() }}
					{{-- Trạng thái Đang Xử Lý có thể huỷ đơn --}}
					<input type="hidden" name="TinhTrang" value="6">
					<input type="hidden" name="TT_TrangThai" value="0">
					<input type="hidden" name="MSDH" value="{{$order->MSDH}}">
					<button class="no-round-btn cart-update">Huỷ Đơn Hàng</button>
				</form>
				@endif
			</div>
			<div class="col-12 col-sm-8"></div>
		</div>
		<div class="row">
			<div class="col-12 col-md-12">
				<div class="progress-track">
					<ul id="progressbar">
						@if($order->TrangThai==0)
							<li class="step0 active" id="step1">Chờ Xác Nhận</li>
							<li class="step0 text-center" id="step2">Chờ Lấy Hàng</li>
							<li class="step0 text-right" id="step3">Đang Giao Hàng</li>
							<li class="step0 text-right" id="step4">Đã Giao Hàng</li>
						@elseif($order->TrangThai==1 || $order->TrangThai==2)
							<li class="step0  active" id="step1">Chờ Xác Nhận</li>
							<li class="step0 text-center active" id="step2">Chờ Lấy Hàng</li>
							<li class="step0 text-right" id="step3">Đang Giao Hàng</li>
							<li class="step0 text-right" id="step4">Đã Giao Hàng</li>
						@elseif($order->TrangThai==3 || $order->TrangThai==4)
							<li class="step0  active" id="step1">Chờ Xác Nhận</li>
							<li class="step0 text-center active" id="step2">Chờ Lấy Hàng</li>
							<li class="step0 text-right active" id="step3">Đang Giao Hàng</li>
							<li class="step0 text-right" id="step4">Đã Giao Hàng</li>
						@elseif($order->TrangThai==5)
							<li class="step0 active" id="step1">Chờ Xác Nhận</li>
							<li class="step0 text-center active" id="step2">Chờ Lấy Hàng</li>
							<li class="step0 text-right active" id="step3">Đang Giao Hàng</li>
							<li class="step0 text-right active" id="step4">Đã Giao Hàng</li>
						@endif
					</ul>
				</div>
			</div>
		</div>
		<div class="row justify-content-end">
			<div class="col-12 col-md-6 col-lg-4">
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
							<tr>
								<th>TRẠNG THÁI</th>
								<td>
									<?php

									if($order->TrangThai ==0){
										echo '<p style="color:red">Đang Xử Lý</p>';
									}elseif($order->TrangThai == 1){
										echo 'Chờ Lấy Hàng';
									}elseif($order->TrangThai ==2){
										echo 'Nhận Đơn';
									}elseif($order->TrangThai ==3){
										echo 'Đang Giao Hàng';
									}elseif($order->TrangThai ==4){
										echo 'Chờ Xác Nhận';
									}elseif($order->TrangThai ==5){
										echo '<p style="color:green">Giao Hàng Thành Công</p>';
									}elseif($order->TrangThai ==6){
										echo 'Đã Huỷ';
									}elseif ($order->TrangThai ==7) {
										echo 'Trả Hàng';
									} 
									?>
								</td>
							</tr>
							@if($order->TrangThai ==7)
							<tr>
								<th>GHI CHÚ</th>
								<td>{{$order->TT_DienGiai}}</td>
							</tr>
							@endif
							<tr>
								<th>THANH TOÁN</th>
								<td>
									<?php
									if($order->TT_TrangThai ==0)
										echo '<p style="color:red">Chưa Thanh Toán</p>';
									elseif($order->TT_TrangThai ==1){
										echo '<p style="color:green">Đã Thanh Toán</p>';
									}else{
										echo '<p style="color:green">Đã Thanh Toán VnPay</p>';
									}
									?>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="row">
						<div class="col-12 justify-content-center align-items-center text-center">
							@if($order->TrangThai==4)
							<form action="{{URL::to('/update_order')}}" method="post">
								{{csrf_field() }}
								<input type="hidden" name="TinhTrang" value="5">
								<input type="hidden" name="MSDH" value="{{$order->MSDH}}">
								<button class="normal-btn cart-update">Đã Nhận Hàng</button>
							</form>
							@endif
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection      