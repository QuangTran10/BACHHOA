@extends('admin_layout')
@section('admin_content')

<div class="content">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card ">
						<div class="card-header card-header-success card-header-icon">
							<div class="card-icon">
								<i class="material-icons">inventory</i>
							</div>
							<h4 class="card-title">Thống kê số lượng sản phẩm bán ra</h4>
						</div>
						<div class="card-body ">
							<table id="datatables" class="table table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
								<thead>
									<tr>
										<th width="10%">Mã SP</th>
										<th width="40%">Tên sản phẩm</th>
										<th width="20%">Số lượng nhập</th>
										<th width="20%">Số lượng bán</th>
										<th style="text-align: center;" width="10%">Tồn kho</th>
									</tr>
								</thead>

								<tbody>
									@foreach($sales as $val)
									@foreach($receipts as $key => $value)
									
									<tr>
										<td>{{$value->MSSP}}</td>
										<td>{{$value->TenSP}}</td>
										<td>{{$value->soluongnhap}}</td>
										<td>
											@if($value->MSSP == $val->MSSP)
												{{$val->soluongban}}
											@else
												0
											@endif
										</td> 
										<td style="text-align: center;">
											@if($value->MSSP == $val->MSSP)
												{{$value->soluongnhap - $val->soluongban}}
											@else
												{{$value->soluongnhap - 0}}
											@endif
										</td>
									</tr>
									@endforeach
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
<script>
	$(document).ready(function() {
		$('#datatables').DataTable({
			"lengthMenu": [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
			],

			responsive: true,
			language: {
				search: "_INPUT_",
				searchPlaceholder: "Tìm kiếm đơn hàng",
				"paginate": {
					"previous": "<<",
					"next": ">>"
				},
				"lengthMenu": "Hiển thị _MENU_",
				"info": "",
			}
		});

		var table = $('#datatable').DataTable();

	});
</script>
@endsection