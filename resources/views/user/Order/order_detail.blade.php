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
					<input type="hidden" name="TinhTrang" value="3">
					<input type="hidden" name="MSDH" value="{{$order->MSDH}}">
					<button class="no-round-btn cart-update">Huỷ Đơn Hàng</button>
				</form>
				@endif
			</div>
			<div class="col-12 col-sm-8"></div>
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
									if($order->TrangThai ==0)
										echo '<p style="color:red">Đang Xử Lý...</p>';
									elseif($order->TrangThai ==1){
										echo '<p style="color:red">Đang Giao Hàng</p>';
									}elseif($order->TrangThai ==2){
										echo '<p style="color:green">Đã Giao Hàng</p>';
									}else{
										echo '<p>Đã Huỷ</p>';
									} 
									?>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="row">
						<div class="col-12 justify-content-center align-items-center text-center">
							@if($order->TrangThai==1)
							<form action="{{URL::to('/update_order')}}" method="post">
								{{csrf_field() }}
								<input type="hidden" name="TinhTrang" value="2">
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