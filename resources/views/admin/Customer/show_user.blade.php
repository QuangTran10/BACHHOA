@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Danh sách khách hàng</h4>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead class="text-warning">
              <th>Mã</th>
              <th>Họ Tên</th>
              <th>Giới Tính</th>
              <th>Ngày Sinh</th>
              <th>Email</th>
              <th style="text-align: center;">Tình Trạng</th>
              <th></th>
            </thead>
            <tbody>
              @foreach($customers as $key => $value)
              <tr>
                <td>{{$value->MSKH}}</td>
                <td>{{$value->HoTenKH}}</td>
                <td>
                  <?php
                  if($value->GioiTinh==1){
                    echo 'Nữ';
                  }elseif ($value->GioiTinh==0) {
                    echo 'Nam';
                  }else{
                    echo 'Khác';
                  }
                  ?>
                </td>
                <td>{{\Carbon\Carbon::parse($value->NgaySinh)->format('d/m/Y')}}</td>
                <td>{{$value->Email}}</td>
                <td style="text-align: center;">
                	<?php
                	if($value->TrangThai ==1)
                		echo '<i class="material-icons" style="color:green;">done</i>';
                	else  
                		echo '<i class="material-icons" style="color:red;">clear</i>';
                	?>
                </td>
                <td>
                	<form>
                		@csrf
                	</form>
                  @if($value->TrangThai==0)
                  <div class="togglebutton">
                    <label>
                      <input type="checkbox" class="toggle-status" data-id="{{$value->MSKH}}">
                      <span class="toggle"></span>
                      Đã Khoá
                    </label>
                  </div>
                  @elseif($value->TrangThai==1)
                  <div class="togglebutton">
                    <label>
                      <input type="checkbox" class="toggle-status" checked="" data-id="{{$value->MSKH}}">
                      <span class="toggle"></span>
                      Đã Mở
                    </label>
                  </div>
                  @endif
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

<script type="text/javascript">
	$(document).ready(function() {
		$('.toggle-status').change(function(event) {
			var id_customer = $(this).data('id');
			var is_checked = $(this).is(':checked');
			var _token = $('input[name="_token"]').val();
			var status;
			if(is_checked == true){
				status = 1;
				swal({
					title: 'Bạn có chắc muốn mở khoá tài khoản',
					text: "You won't be able to revert this!",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'OK!'
				}).then(function() {
					$.ajax({
						url: '{{url('/status_user')}}',
						method: "POST",
						data:{
							id_customer: id_customer,
							status: status,
							_token: _token },
							success:function(data){
								if(data=1){
									location.reload();
								}else if(data==0){
									Swal.fire({
										icon: 'error',
										title: 'Lỗi',
									})
								}
							}
						});
				})
			}else{
				status = 0;
				swal({
					title: 'Bạn có chắc muốn khoá tài khoản',
					text: "You won't be able to revert this!",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'OK!'
				}).then(function() {
					$.ajax({
						url: '{{url('/status_user')}}',
						method: "POST",
						data:{
							id_customer: id_customer,
							status: status,
							_token: _token },
							success:function(data){
								if(data=1){
									location.reload();
								}else if(data==0){
									Swal.fire({
										icon: 'error',
										title: 'Lỗi',
									})
								}
							}
						});
				})
			}


		});
	});
</script>

@endsection
