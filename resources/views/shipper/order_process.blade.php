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
		<div class="table-contents z-depth-1 ">
			<div class="card horizontal">
				<div class="card-image">
					<img src="{{('public/backend/shipper/images/6-chai-nuoc-ngot-coca-cola-390ml1652428332.jpg')}}" >
				</div>
				<div class="card-stacked">
					<div class="card-content">
						<p>I am a very simple card. I am good at containing small bits of information.</p>
					</div>
					<div class="card-action">
						<a href="#">This is a link</a>
					</div>
				</div>
			</div>
			{{-- <table class="responsive-table">
				<thead>
					<tr>
						<th>Mã Đơn</th>
						<th>Địa Chỉ</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Mathias</td>
						<td>Designer</td>
						<td></td>
					</tr>
					<tr>
						<td>Mathias</td>
						<td>Designer</td>
						<td></td>
					</tr>
					<tr>
						<td>Mathias</td>
						<td>Designer</td>
						<td></td>
					</tr>
					<tr>
						<td>Mathias</td>
						<td>Designer</td>
						<td></td>
					</tr>
					<tr>
						<td>Mathias</td>
						<td>Designer</td>
						<td></td>
					</tr>
				</tbody>
			</table> --}}
		</div>
	</div>
</div>

<div class="segments-page">
		<div class="container">
			<div class="collapse">
				<div class="pages-title">
					<h3>Đơn Hàng Của Bạn</h3>
				</div>
				<ul class="collapsible" data-collapsible="accordion">
					@foreach($order as $key => $value)
					<li>
						<div class="collapsible-header text-bold active">
							<i class="fas fa-shopping-bag"></i>#{{$value->MSDH}}
						</div>
						<div class="collapsible-body">
							<div class="table-contents z-depth-1 ">
								<table>
									<thead>
										<tr>
											<th>Tên Sản Phẩm</th>
											<th>Số Lượng</th>
											<th>Thành Tiền</th>
										</tr>
									</thead>
									<tbody>
										@foreach($order_details as $k => $val)
											@if($val->MSDH == $value->MSDH)
											<tr>
												<td>{{$val->TenSP}}</td>
												<td>{{$val->SoLuong}}</td>
												<td>{{$val->ThanhTien}}</td>
											</tr>
											@endif
										@endforeach
										<tr>
											<td></td>
											<td>Tổng</td>
											<td>{{$value->ThanhTien}}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
@endsection	