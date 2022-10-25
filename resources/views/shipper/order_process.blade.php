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
			<div class="collapse">
				<div class="pages-title">
					<h3>Đơn Hàng Của Bạn</h3>
				</div>
				<ul class="collapsible" data-collapsible="accordion">
					@foreach($order as $key => $value)
					<li>
						@if($value->TrangThai==1 && $value->MSGH != null)
							<div class="collapsible-header text-bold active" style="color: red;">
								<i class="fas fa-shopping-bag"></i>#{{$value->MSDH}}...Chờ Nhận Đơn
							</div>
						@elseif($value->TrangThai==2 && $value->MSGH != null)
							<div class="collapsible-header text-bold active" style="color: #ff9800;">
								<i class="fas fa-shopping-bag"></i>#{{$value->MSDH}}...Đã Nhận Đơn
							</div>
						@elseif($value->TrangThai==5 && $value->MSGH != null)	
							<div class="collapsible-header text-bold active" style="color: green;">
								<i class="fas fa-shopping-bag"></i>#{{$value->MSDH}}...Giao Hàng Thành Công
							</div>
						@elseif($value->TrangThai==7 && $value->MSGH != null)
							<div class="collapsible-header text-bold active" style="color: red;">
								<i class="fas fa-shopping-bag"></i>#{{$value->MSDH}}...Giao Hàng Không Thành Công
							</div>
						@else
							<div class="collapsible-header text-bold active" style="color: #0091ea ;">
								<i class="fas fa-shopping-bag"></i>#{{$value->MSDH}}...Đang Giao Hàng
							</div>
						@endif

						<div class="collapsible-body">
							@foreach($order_details as $k => $val)
							@if($val->MSDH == $value->MSDH)
							<div class="cart">
								<div class="cart-product">
									<div class="row">
										<div class="col s4">
											<div class="contents">
												<img src="{{asset('public/upload/'.$val->Image)}}" alt="">
											</div>
										</div>
										<div class="col s8">
											<div class="contents">
												<a href="">{{$val->TenSP}}</a>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col s4">
											<div class="contents">
												<p>Giá</p>
											</div>
										</div>
										<div class="col s8">
											<div class="contents">
												@if($val->GiamGia==0)

												<p>{{number_format($val->GiaDatHang, 0, ',', ' ')}}đ</p>
												@else

												<p>
													<del>{{number_format($val->GiaDatHang, 0, ',', ' ')}}đ </del>
													{{number_format($val->GiaDatHang*(1-$val->GiamGia), 0, ',', ' ')}}đ
												</p>
												@endif
											</div>
										</div>
										<div class="col s4">
											<div class="contents">
												<p>Số Lượng</p>
											</div>
										</div>
										<div class="col s6">
											<div class="contents">
												<p>x{{$val->SoLuong}}</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							@endif
							@endforeach
							<div class="total-pay">
								<div class="row">
									<div class="col s4">
										<div class="contents">
											<b>Họ tên</b>
										</div>
									</div>
									<div class="col s8">
										<div class="contents right">
											<p>{{$value->HoTen}}</p>
										</div>
									</div>
									<div class="col s4">
										<div class="contents">
											<b>Số điện thoại</b>
										</div>
									</div>
									<div class="col s8">
										<div class="contents right">
											<p>{{$value->SDT}}</p>
										</div>
									</div>
									<div class="col s4">
										<div class="contents">
											<b>Địa Chỉ</b>
										</div>
									</div>
									<div class="col s8">
										<div class="contents right">
											<p>{{$value->DiaChi}}</p>
										</div>
									</div>
									<div class="col s8">
										<div class="contents">
											<h5>Tổng số tiền</h5>
										</div>
									</div>
									<div class="col s4">
										<div class="contents right">
											<h5>{{ number_format($value->ThanhTien, 0, ',', ' ')}} đ</h5>
										</div>
									</div>
								</div>
								<form>
									{{csrf_field()}}
								</form>
								@if($value->TrangThai==1)
								<button class="button green order-accept" data-id="{{$value->MSDH}}"> Nhận Đơn</button>
								<button class="button red accent-4 order-reject" data-id="{{$value->MSDH}}">Từ Chối</button>
								@endif

								@if($value->TrangThai==2)
								<button class="button yellow accent-2 black-text order-shipping" data-id="{{$value->MSDH}}">Đã Lấy Hàng</button>
								@endif
								
							</div>
							@if($value->TrangThai==3)
							<div class="total-pay">
								<form action="{{URL::to('/complete_status_order')}}" method="post" enctype="multipart/form-data">
									{{csrf_field()}}
									<div class="row">
										<div class="col s5">
											<p>
												<label>
													<input value="4" name="status" class="status_order" id="success" type="radio"/>
													<span style="color: black">Giao hàng thành công</span>
												</label>
											</p>
											<p>
												<label>
													<input value="7" name="status" class="status_order" id="fail" type="radio"/>
													<span style="color: black">Giao hàng không thành công</span>
												</label>
											</p>
										</div>
									</div>
									<input type="hidden" name="MSDH" value="{{$value->MSDH}}">
									<div id="content_order">

									</div>
									<input class="button blue darken-4" type="submit" name="XacNhan" value="Xác Nhận">
								</form>
								
							</div>	
							@endif

						</div>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
@endsection	