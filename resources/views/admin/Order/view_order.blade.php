@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
	<h3 class="title mt-4 text-center" style="font-weight: bold;">CHI TIẾT ĐƠN HÀNG</h3>
	@foreach($order_by_id as $key =>$value)
	@php
		$tong=$value->ThanhTien;
	@endphp
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-sm-6">
					<h3><b>Thông Tin Khách Hàng</b></h3>
					<div class="dropdown-divider"></div>
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<td width="30%">Họ Và Tên</td>
									<td width="70%">{{$value->HoTenKH}}</td>
								</tr>
								<tr>
									<td>Giới Tính</td>
									<td>
										<?php
										if($value->GioiTinh==0){
											echo 'Nam';
										}elseif ($value->GioiTinh==1) {
											echo 'Nữ';
										}else{
											echo 'Khác';
										}
										?>
									</td>
								</tr>
								<tr>
									<td>Ngày Sinh</td>
									<td>
										{{\Carbon\Carbon::parse($value->NgaySinh)->format('d/m/Y')}}
									</td>
								</tr>
								<tr>
									<td>Số Điện Thoại</td>
									<td>{{$value->SDT}}</td>
								</tr>
								<tr>
									<td>Email</td>
									<td>{{$value->Email}}</td>
								</tr>
							</tbody>
						</table>
					</div>		
				</div>
				<div class="col-sm-6">
					<h3><b>Thông Tin Đơn Hàng</b></h3>
					<div class="dropdown-divider"></div>
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<td width="30%">Họ Và Tên</td>
									<td width="70%">{{$value->HoTen}}</td>
								</tr>
								<tr>
									<td>Địa Chỉ Giao Hàng</td>
									<td>{{$value->DiaChi}}</td>
								</tr>
								<tr>
									<td>Ngày Đặt Hàng</td>
									<td>{{\Carbon\Carbon::parse($value->NgayDat )->format('d/m/Y')}}</td>
								</tr>
								<tr>
									<td>Ngày Giao Hàng</td>
									<td>
										@if($value->NgayGiao==NULL)
										Chưa Giao Hàng
										@else
										{{\Carbon\Carbon::parse($value->NgayGiao )->format('d/m/Y')}}
										@endif
									</td>
								</tr>
								<tr>
									<td>Số Điện Thoại</td>
									<td>{{$value->SDT}}</td>
								</tr>
								<tr>
									<td>Loại Giao Hàng</td>
									<td>
										{{$value->TT_Ten}}
									</td>
								</tr>
								<tr>
									<td>Tình Trạng</td>
									<td>
										<?php
										$Status = $value->TrangThai;
										if($value->TrangThai ==0)
											echo 'Đang Xử Lý';
										elseif($value->TrangThai ==1){
											echo 'Đang Giao Hàng';
										}elseif($value->TrangThai ==2){
											echo 'Đã Giao Hàng';
										}else{
											echo 'Đã Huỷ';
										} 
										?>
									</td>
								</tr>
								<tr>
									<td>Thanh Toán</td>
									<td>
										<?php
										if($value->TT_TrangThai ==0)
											echo 'Chưa Thanh Toán';
										elseif($value->TT_TrangThai ==1){
											echo 'Đã Thanh Toán';
										}elseif($value->TT_TrangThai==2){
											echo 'Thanh Toán VNPAY';
										}else{
											echo 'Thanh Toán MOMO';
										}
										?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>	
				</div>
			</div>
		</div>
	</div>
	@endforeach
	<div class="row">
		<div class="col-lg-12 col-md-12"></div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="card">
				<div class="card-header card-header-primary">
					<h4 class="card-title">Danh sách sản phẩm</h4>
				</div>
				<div class="card-body table-responsive">
					<table class="table table-hover">
						<thead class="text-warning">
							<th width="10%">Mã</th>
							<th width="20%">Tên Sản Phẩm</th>
							<th width="10%">Số Lượng</th>
							<th width="20%">Giá</th>
							<th width="20%">Giảm Giá</th>
							<th width="20%">Thành Tiền</th>
						</thead>
						<tbody>
							@php
							$dis_total=0;
							@endphp
							@foreach($order_details as $order_val)
								@php
								$dis_total=$dis_total + $order_val->SoLuong*$order_val->GiaDatHang*($order_val->GiamGia);
								@endphp
							<tr>
								<td>{{$order_val->MSSP}}</td>
								<td>{{$order_val->TenSP}}</td>
								<td>{{$order_val->SoLuong}}</td>
								<td>{{$order_val->GiaDatHang}}</td>
								<td>{{$order_val->GiamGia*100}}%</td>
								<td>{{$order_val->ThanhTien}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>  {{-- end card body --}}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="card">
				<div class="card-body">
					<table>
						<tbody style="font-size: 18px">
							<tr>
								<td><b>Phí vận chuyển:</b></td>
								<td>
									@if($tong >1000000)
										Miễn phí giao hàng
									@else
										{{number_format(30000 , 0, ',', ' ').'đ';}}
									@endif
								</td>
							</tr>
							<tr>
								<td><b>Số tiền đã giảm:</b></td>
								<td><?php echo number_format($dis_total , 0, ',', ' ').'đ'; ?></td>
							</tr>
							<tr>
								<td><b>Thành Tiền:</b></td>
								<td><?php echo number_format($tong , 0, ',', ' ').'đ'; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>
	@if(session('notice'))
	<p style="color: red">
		{{session('notice')}}
	</p>
	@endif
	<div class="row">
		<div class="col-lg-2 col-md-2">
			<form action="{{URL::to('/update_status')}}" method="post">
				{{csrf_field()}}
				<input type="hidden" name="SoDonDH" value="{{$MSDH}}">
				<input type="hidden" name="TinhTrang" value="1">
				<input type="submit" name="Update" value="Xác Nhận" class="btn btn-success" <?php if($Status==3 || $Status==1 || $Status==2) echo 'disabled=""';?>>
			</form>
		</div>
		<div class="col-lg-2 col-md-2">
			<a href="{{URL::to('/order_management')}}" class="btn btn-danger">Quay Lại</a>
		</div>
		<div class="col-lg-2 col-md-2">
			<a target="_blank" href="{{URL::to('/print_order/'.$MSDH)}}" class="btn btn-info" <?php if($Status==3) {echo 'style="pointer-events: none;cursor: default;" ';};?>  >In Đơn Hàng</a>
		</div>
	</div>
</div>

@endsection