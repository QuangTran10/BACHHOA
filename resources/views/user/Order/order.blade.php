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

<div class="feature-products feature-products_v2">
	<div class="ogami-container-fluid">
		<div class="row">
			<div class="col-12 text-center">
				<h1 class="title mx-auto">ĐƠN HÀNG CỦA TÔI</h1>
			</div>
			<div class="col-12">
				<div id="tab">
					<ul class="tab-control">
						<li><a class="active" href="#tab-2">Chờ Xác Nhận</a></li>
						<li><a href="#tab-3">Chờ Lấy Hàng</a></li>
						<li><a href="#tab-4">Đang Giao</a></li>
						<li><a href="#tab-5">Đã Giao</a></li>
						<li><a href="#tab-6">Đã Huỷ</a></li>
						<li><a href="#tab-7">Trả Hàng</a></li>
					</ul>

					<div id="tab-2">
						<div class="no-gutters-sm">
							@foreach($orders as $key => $value)
							@if($value->TrangThai == 0)
							<div class="order-history container">
								<div class="order-table">
									<table class="table"> 
										<colgroup>
											<col span="1" style="width: 20%">
											<col span="1" style="width: 30%">
											<col span="1" style="width: 15%">
											<col span="1" style="width: 15%">
											<col span="1" style="width: 20%">
										</colgroup>
										<tr>
											<th colspan="2" style="text-align: left;">Đơn hàng #{{$value->MSDH}}</th>
											<th colspan="3" style="text-align: right; color: green;">Chờ Xác Nhận</th>
										</tr>
										<tbody>
											@foreach($order_details as $k => $val)
											@if($val->MSDH == $value->MSDH)
											<tr>
												<td class="order-image"> 
													<div class="img-order"><img src="{{asset('public/upload/'.$val->Image)}}" alt="product image"></div>
												</td>
												<td class="order-name">{{$val->TenSP}}</td>
												<td class="order-price">
													{{number_format($val->GiaDatHang , 0, ',', ' ')}} đ
												</td>
												<td class="order-quantity"> 
													x {{$val->SoLuong}}
												</td>
												<td class="order-total">
													{{number_format($val->ThanhTien , 0, ',', ' ')}} đ
												</td>
											</tr>
											@endif
											@endforeach
										</tbody>
										<tr>
											<td class="order-clear" colspan="2">
												<a class="no-round-btn" href="{{URL::to('/order_detail/'.$value->MSDH)}}">Chi tiết đơn hàng</a>
											</td>
											<td class="order-header" colspan="3">Tổng số tiền: {{number_format($value->ThanhTien , 0, ',', ' ')}} đ</td>
										</tr>
									</table>
								</div>
							</div>
							@endif
							@endforeach
						</div>
					</div>
					<div id="tab-3">
						<div class="no-gutters-sm">
							@foreach($orders as $key => $value)
							@if($value->TrangThai == 1 || $value->TrangThai==2)
							<div class="order-history container">
								<div class="order-table">
									<table class="table"> 
										<colgroup>
											<col span="1" style="width: 25%">
											<col span="1" style="width: 35%">
											<col span="1" style="width: 15%">
											<col span="1" style="width: 15%">
											<col span="1" style="width: 20%">
										</colgroup>
										<tr>
											<th colspan="2" style="text-align: left;">Đơn hàng #{{$value->MSDH}}</th>
											<th colspan="3" style="text-align: right; color: green;">Chờ Lấy Hàng</th>
										</tr>
										<tbody>
											@foreach($order_details as $k => $val)
											@if($val->MSDH == $value->MSDH)
											<tr>
												<td class="order-image"> 
													<div class="img-order"><img src="{{asset('public/upload/'.$val->Image)}}" alt="product image"></div>
												</td>
												<td class="order-name">{{$val->TenSP}}</td>
												<td class="order-price">
													{{number_format($val->GiaDatHang , 0, ',', ' ')}} đ
												</td>
												<td class="order-quantity"> 
													x {{$val->SoLuong}}
												</td>
												<td class="order-total">
													{{number_format($val->ThanhTien , 0, ',', ' ')}} đ
												</td>
											</tr>
											@endif
											@endforeach
										</tbody>
										<tr>
											<td class="order-clear" colspan="2">
												<a class="no-round-btn" href="{{URL::to('/order_detail/'.$value->MSDH)}}">Chi tiết đơn hàng</a>
											</td>
											<td class="order-header" colspan="3">Tổng số tiền: {{number_format($value->ThanhTien , 0, ',', ' ')}} đ</td>
										</tr>
									</table>
								</div>
							</div>
							@endif
							@endforeach
						</div>
					</div>
					<div id="tab-4"> 
						<div class="no-gutters-sm">
							@foreach($orders as $key => $value)
							@if($value->TrangThai == 3)
							<div class="order-history container">
								<div class="order-table">
									<table class="table"> 
										<colgroup>
											<col span="1" style="width: 25%">
											<col span="1" style="width: 35%">
											<col span="1" style="width: 15%">
											<col span="1" style="width: 15%">
											<col span="1" style="width: 20%">
										</colgroup>
										<tr>
											<th colspan="2" style="text-align: left;">Đơn hàng #{{$value->MSDH}}</th>
											<th colspan="3" style="text-align: right; color: green;">
												<i class="fas fa-shipping-fast"></i> Đang Giao
											</th>
										</tr>
										<tbody>
											@foreach($order_details as $k => $val)
											@if($val->MSDH == $value->MSDH)
											<tr>
												<td class="order-image"> 
													<div class="img-order"><img src="{{asset('public/upload/'.$val->Image)}}" alt="product image"></div>
												</td>
												<td class="order-name">{{$val->TenSP}}</td>
												<td class="order-price">
													{{number_format($val->GiaDatHang , 0, ',', ' ')}} đ
												</td>
												<td class="order-quantity"> 
													x {{$val->SoLuong}}
												</td>
												<td class="order-total">
													{{number_format($val->ThanhTien , 0, ',', ' ')}} đ
												</td>
											</tr>
											@endif
											@endforeach
										</tbody>
										<tr>
											<td class="order-clear" colspan="2">
												<a class="no-round-btn" href="{{URL::to('/order_detail/'.$value->MSDH)}}">Chi tiết đơn hàng</a>
											</td>
											<td class="order-header" colspan="3">Tổng số tiền: {{number_format($value->ThanhTien , 0, ',', ' ')}} đ</td>
										</tr>
									</table>
								</div>
							</div>
							@endif
							@endforeach
						</div>
					</div>
					<div id="tab-5"> 
						<div class="no-gutters-sm">
							@foreach($orders as $key => $value)
							@if($value->TrangThai == 4 || $value->TrangThai==5)
							<div class="order-history container">
								<div class="order-table">
									<table class="table"> 
										<colgroup>
											<col span="1" style="width: 25%">
											<col span="1" style="width: 35%">
											<col span="1" style="width: 15%">
											<col span="1" style="width: 15%">
											<col span="1" style="width: 20%">
										</colgroup>
										<tr>
											<th colspan="2" style="text-align: left;">Đơn hàng #{{$value->MSDH}}</th>
											<th colspan="3" style="text-align: right; color: green;">
												<i class="fas fa-shipping-fast"></i> Giao hàng thành công
											</th>
										</tr>
										<tbody>
											@foreach($order_details as $k => $val)
											@if($val->MSDH == $value->MSDH)
											<tr>
												<td class="order-image"> 
													<div class="img-order"><img src="{{asset('public/upload/'.$val->Image)}}" alt="product image"></div>
												</td>
												<td class="order-name">{{$val->TenSP}}</td>
												<td class="order-price">
													{{number_format($val->GiaDatHang , 0, ',', ' ')}} đ
												</td>
												<td class="order-quantity"> 
													x {{$val->SoLuong}}
												</td>
												<td class="order-total">
													{{number_format($val->ThanhTien , 0, ',', ' ')}} đ
												</td>
											</tr>
											@endif
											@endforeach
										</tbody>
										<tr>
											<td class="order-clear" colspan="2">
												<a class="no-round-btn" href="{{URL::to('/order_detail/'.$value->MSDH)}}">Chi tiết đơn hàng</a>
											</td>
											<td class="order-header" colspan="3">Tổng số tiền: {{number_format($value->ThanhTien , 0, ',', ' ')}} đ</td>
										</tr>
									</table>
								</div>
							</div>
							@endif
							@endforeach
						</div>
					</div>
					<div id="tab-6">
						<div class="no-gutters-sm">
							@foreach($orders as $key => $value)
							@if($value->TrangThai == 6)
							<div class="order-history container">
								<div class="order-table">
									<table class="table"> 
										<colgroup>
											<col span="1" style="width: 25%">
											<col span="1" style="width: 35%">
											<col span="1" style="width: 15%">
											<col span="1" style="width: 15%">
											<col span="1" style="width: 20%">
										</colgroup>
										<tr>
											<th colspan="2" style="text-align: left;">Đơn hàng #{{$value->MSDH}}</th>
											<th colspan="3" style="text-align: right; color: red;">
												ĐÃ HUỶ
											</th>
										</tr>
										<tbody>
											@foreach($order_details as $k => $val)
											@if($val->MSDH == $value->MSDH)
											<tr>
												<td class="order-image"> 
													<div class="img-order"><img src="{{asset('public/upload/'.$val->Image)}}" alt="product image"></div>
												</td>
												<td class="order-name">{{$val->TenSP}}</td>
												<td class="order-price">
													{{number_format($val->GiaDatHang , 0, ',', ' ')}} đ
												</td>
												<td class="order-quantity"> 
													x {{$val->SoLuong}}
												</td>
												<td class="order-total">
													{{number_format($val->ThanhTien , 0, ',', ' ')}} đ
												</td>
											</tr>
											@endif
											@endforeach
										</tbody>
										<tr>
											<td class="order-clear" colspan="2">
												<a class="no-round-btn" href="{{URL::to('/order_detail/'.$value->MSDH)}}">Chi tiết đơn hàng</a>
											</td>
											<td class="order-header" colspan="3">Tổng số tiền: {{number_format($value->ThanhTien , 0, ',', ' ')}} đ</td>
										</tr>
									</table>
								</div>
							</div>
							@endif
							@endforeach
						</div>
					</div>

					<div id="tab-7">
						<div class="no-gutters-sm">
							@foreach($orders as $key => $value)
							@if($value->TrangThai == 7)
							<div class="order-history container">
								<div class="order-table">
									<table class="table"> 
										<colgroup>
											<col span="1" style="width: 25%">
											<col span="1" style="width: 35%">
											<col span="1" style="width: 15%">
											<col span="1" style="width: 15%">
											<col span="1" style="width: 20%">
										</colgroup>
										<tr>
											<th colspan="2" style="text-align: left;">Đơn hàng #{{$value->MSDH}}</th>
											<th colspan="3" style="text-align: right; color: red;">
												TRẢ HÀNG
											</th>
										</tr>
										<tbody>
											@foreach($order_details as $k => $val)
											@if($val->MSDH == $value->MSDH)
											<tr>
												<td class="order-image"> 
													<div class="img-order"><img src="{{asset('public/upload/'.$val->Image)}}" alt="product image"></div>
												</td>
												<td class="order-name">{{$val->TenSP}}</td>
												<td class="order-price">
													{{number_format($val->GiaDatHang , 0, ',', ' ')}} đ
												</td>
												<td class="order-quantity"> 
													x {{$val->SoLuong}}
												</td>
												<td class="order-total">
													{{number_format($val->ThanhTien , 0, ',', ' ')}} đ
												</td>
											</tr>
											@endif
											@endforeach
										</tbody>
										<tr>
											<td class="order-clear" colspan="2">
												<a class="no-round-btn" href="{{URL::to('/order_detail/'.$value->MSDH)}}">Chi tiết đơn hàng</a>
											</td>
											<td class="order-header" colspan="3">Tổng số tiền: {{number_format($value->ThanhTien , 0, ',', ' ')}} đ</td>
										</tr>
									</table>
								</div>
							</div>
							@endif
							@endforeach
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

@endsection