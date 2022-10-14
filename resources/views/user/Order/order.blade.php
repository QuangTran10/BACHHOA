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
						<li><a class="active" href="#tab-1">Tất cả</a></li>
						<li><a href="#tab-2">Chờ Xác Nhận</a></li>
						<li><a href="#tab-3">Chờ Lấy Hàng</a></li>
						<li> <a href="#tab-4">Đang Giao</a></li>
						<li> <a href="#tab-5">Đã Giao</a></li>
						<li><a href="#tab-6">Đã Huỷ</a></li>
					</ul>

					<div id="tab-1">
						<div class="no-gutters-sm">
							<div class="shop-compare">
								<div class="container">
									<div class="row">
										<div class="col-12">
											<div class="compre-table">
												<table class="table table-responsive"> 
													<colgroup>
														<col span="1" style="width: 25%">
														<col span="1" style="width: 25%">
														<col span="1" style="width: 25%">
														<col span="1" style="width: 25%">
													</colgroup>
													<tbody>
														{{-- <tr>
															<th scope="row">Mã Đơn Hàng</th>
															<th>Thời Gian Đặt Hàng</th>
															<th>Thành Tiền</th>
															<th></th>
														</tr>
														@foreach($orders_cancel as $value1)
														<tr>
															<th scope="row">{{$value1->MSDH}}</th>
															<td class="product-price">{{$value1->NgayDat}}</td>
															<td class="product-price">
																{{number_format($value1->ThanhTien , 0, ',', ' ').'đ';}}</td>
															</td>
															<td class="product-price">
																
															</td>
														</tr>
														@endforeach --}}
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>	
							</div>
						</div>
					</div>

					<div id="tab-2">
						<div class="no-gutters-sm">
							<div class="shop-compare">
								<div class="container">
									<div class="row">
										<div class="col-12">
											<div class="compre-table">
												<table class="table table-responsive"> 
													<colgroup>
														<col span="1" style="width: 25%">
														<col span="1" style="width: 25%">
														<col span="1" style="width: 25%">
														<col span="1" style="width: 25%">
													</colgroup>
													<tbody>
														<tr>
															<th scope="row">Mã Đơn Hàng</th>
															<th>Thời Gian Đặt Hàng</th>
															<th>Thành Tiền</th>
															<th></th>
														</tr>
														@foreach($orders_process as $value1)
														<tr>
															<th scope="row">{{$value1->MSDH}}</th>
															<td class="product-price">{{$value1->NgayDat}}</td>
															<td class="product-price">
																{{number_format($value1->ThanhTien , 0, ',', ' ').'đ';}}</td>
															</td>
															<td class="product-price">
																<a class="no-round-btn" href="{{URL::to('/order_detail/'.$value1->MSDH)}}"><i class="far fa-eye"></i></a>
															</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>	
							</div>
						</div>
					</div>
					<div id="tab-3">
						<div class="no-gutters-sm">
							<div class="shop-compare">
								<div class="container">
									<div class="row">
										<div class="col-12">
											<div class="compre-table">
												<table class="table table-responsive"> 
													<colgroup>
														<col span="1" style="width: 25%">
														<col span="1" style="width: 25%">
														<col span="1" style="width: 25%">
														<col span="1" style="width: 25%">
													</colgroup>
													<tbody>
														<tr>
															<th scope="row">Mã Đơn Hàng</th>
															<th>Thời Gian Đặt Hàng</th>
															<th>Thành Tiền</th>
															<th></th>
														</tr>
														@foreach($orders_shipping as $value1)
														<tr>
															<th scope="row">{{$value1->MSDH}}</th>
															<td class="product-price">{{$value1->NgayDat}}</td>
															<td class="product-price">
																{{number_format($value1->ThanhTien , 0, ',', ' ').'đ';}}</td>
															</td>
															<td class="product-price">
																<a class="no-round-btn" href="{{URL::to('/order_detail/'.$value1->MSDH)}}"><i class="far fa-eye"></i></a>
															</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>	
							</div>
						</div>
					</div>
					<div id="tab-5"> 
						<div class="no-gutters-sm">
							<div class="shop-compare">
								<div class="container">
									<div class="row">
										<div class="col-12">
											<div class="compre-table">
												<table class="table table-responsive"> 
													<colgroup>
														<col span="1" style="width: 25%">
														<col span="1" style="width: 25%">
														<col span="1" style="width: 25%">
														<col span="1" style="width: 25%">
													</colgroup>
													<tbody>
														<tr>
															<th scope="row">Mã Đơn Hàng</th>
															<th>Thời Gian Đặt Hàng</th>
															<th>Thành Tiền</th>
															<th></th>
														</tr>
														@foreach($orders_delivered as $value1)
														<tr>
															<th scope="row">{{$value1->MSDH}}</th>
															<td class="product-price">{{$value1->NgayDat}}</td>
															<td class="product-price">
																{{number_format($value1->ThanhTien , 0, ',', ' ').'đ';}}</td>
															</td>
															<td class="product-price">
																<a class="no-round-btn" href="{{URL::to('/order_detail/'.$value1->MSDH)}}"><i class="far fa-eye"></i></a>
															</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>	
							</div>
						</div>
					</div>
					<div id="tab-6">
						<div class="no-gutters-sm">
							<div class="shop-compare">
								<div class="container">
									<div class="row">
										<div class="col-12">
											<div class="compre-table">
												<table class="table table-responsive"> 
													<colgroup>
														<col span="1" style="width: 25%">
														<col span="1" style="width: 25%">
														<col span="1" style="width: 25%">
														<col span="1" style="width: 25%">
													</colgroup>
													<tbody>
														<tr>
															<th scope="row">Mã Đơn Hàng</th>
															<th>Thời Gian Đặt Hàng</th>
															<th>Thành Tiền</th>
															<th></th>
														</tr>
														@foreach($orders_cancel as $value1)
														<tr>
															<th scope="row">{{$value1->MSDH}}</th>
															<td class="product-price">{{$value1->NgayDat}}</td>
															<td class="product-price">
																{{number_format($value1->ThanhTien , 0, ',', ' ').'đ';}}</td>
															</td>
															<td class="product-price">
																
															</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>	
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

@endsection