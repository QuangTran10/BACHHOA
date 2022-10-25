@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
	<div class="header text-center ml-auto mr-auto">
		<h3 class="title mt-4 text-center" style="font-weight: bold;">CHI TIẾT ĐƠN HÀNG</h3>
		<p class="category">Nhân Viên: {{$NameStaff}}</p>
	</div>
	@php
		$tong=$order_by_id->ThanhTien;
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
									<td width="70%">{{$order_by_id->HoTenKH}}</td>
								</tr>
								<tr>
									<td>Giới Tính</td>
									<td>
										<?php
										if($order_by_id->GioiTinh==0){
											echo 'Nam';
										}elseif ($order_by_id->GioiTinh==1) {
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
										{{\Carbon\Carbon::parse($order_by_id->NgaySinh)->format('d/m/Y')}}
									</td>
								</tr>
								<tr>
									<td>Số Điện Thoại</td>
									<td>{{$order_by_id->SDT}}</td>
								</tr>
								<tr>
									<td>Email</td>
									<td>{{$order_by_id->Email}}</td>
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
									<td width="70%">{{$order_by_id->HoTen}}</td>
								</tr>
								<tr>
									<td>Địa Chỉ Giao Hàng</td>
									<td>{{$order_by_id->DiaChi}}</td>
								</tr>
								<tr>
									<td>Ngày Đặt Hàng</td>
									<td>{{\Carbon\Carbon::parse($order_by_id->NgayDat )->format('d/m/Y')}}</td>
								</tr>
								<tr>
									<td>Ngày Giao Hàng</td>
									<td>
										@if($order_by_id->NgayGiao==NULL)
										Chưa Giao Hàng
										@else
										{{\Carbon\Carbon::parse($order_by_id->NgayGiao )->format('d/m/Y')}}
										@endif
									</td>
								</tr>
								<tr>
									<td>Số Điện Thoại</td>
									<td>{{$order_by_id->SDT}}</td>
								</tr>
								<tr>
									<td>Loại Giao Hàng</td>
									<td>
										{{$order_by_id->TT_Ten}}
									</td>
								</tr>
								<tr>
									<td>Tình Trạng</td>
									<td>
										<?php
										$Status = $order_by_id->TrangThai;
										if($order_by_id->TrangThai ==0){
											echo 'Đang Xử Lý';
										}elseif($order_by_id->TrangThai == 1){
											echo 'Chờ Lấy Hàng';
										}elseif($order_by_id->TrangThai ==2){
											echo 'Nhận Đơn';
										}elseif($order_by_id->TrangThai ==3){
											echo 'Đang Giao Hàng';
										}elseif($order_by_id->TrangThai ==5||$order_by_id->TrangThai ==4){
											echo 'Giao Hàng Thành Công';
										}elseif($order_by_id->TrangThai ==6){
											echo 'Đã Huỷ';
										}elseif ($order_by_id->TrangThai ==7) {
											echo 'Trả Hàng';
										} 
										?>
									</td>
								</tr>
								@if($order_by_id->TrangThai==7)
								<tr style="font-weight: bold;">
									<td>Ghi Chú</td>
									<td>{{$order_by_id->TT_DienGiai}}</td>
								</tr>
								@endif
								<tr>
									<td>Thanh Toán</td>
									<td>
										<?php
										if($order_by_id->TT_TrangThai ==0)
											echo 'Chưa Thanh Toán';
										elseif($order_by_id->TT_TrangThai ==1){
											echo 'Đã Thanh Toán';
										}elseif($order_by_id->TT_TrangThai==2){
											echo 'Thanh Toán VNPAY';
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
		<div class="col-lg-12 col-md-12">
			<div class="card">
				<div class="card-body">
					@if($Status==1)
					<form>
						{{csrf_field()}}
						<div class="form-group">
							<label class="bmd-label-floating">Chọn nhân viên giao hàng</label>
							<select class="selectpicker" data-style="select-with-transition" title="Chọn" data-size="7" name="GiaoHang" id="id_shipper">
								@foreach($shipper as $k )
								<option value="{{$k->MSGH}}" {{ ($order_by_id->MSGH!=null && $order_by_id->MSGH == $k->MSGH)? "selected" : "" }}>{{$k->HoTenGH}}</option>
								@endforeach
							</select>
							<input type="hidden" name="MSDH" value="{{$MSDH}}" id="id_order">
							<button type="button" class="btn btn-warning btn-round btn-just-icon btn-choose-shipper">
								<i class="material-icons">send</i> 
								<div class="ripple-container"></div>
							</button>
						</div>
					</form>
					@endif

					<div class="row">
						<div class="col-lg-2 col-md-2">
							<form action="{{URL::to('/update_status')}}" method="post">
								{{csrf_field()}}
								<input type="hidden" name="SoDonDH" value="{{$MSDH}}">
								<input type="hidden" name="TinhTrang" value="1">
								<input type="submit" name="Update" value="Xác Nhận" class="btn btn-success" <?php if($Status!=0) echo 'disabled=""';?>>
							</form>
						</div>
						
						<div class="col-lg-2 col-md-2">
							<a target="_blank" href="{{URL::to('/print_order/'.$MSDH)}}" class="btn btn-info"><i class="material-icons">print</i> In Đơn Hàng</a>
						</div>

						<div class="col-lg-2 col-md-2">
							<a href="{{URL::to('/order_management')}}" class="btn btn-danger"><i class="material-icons">reply</i> Quay Lại</a>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

@endsection