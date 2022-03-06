@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <a href="{{URL::to('/add_staff')}}" class="btn btn-primary btn-lg" role="button" aria-disabled="true">
         <i class="material-icons">edit</i> Thêm Nhân Viên
      </a>
    </div>
  </div>  
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Danh sách nhân viên</h4>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead class="text-warning">
              <th>Mã Nhân Viên</th>
              <th>Họ Tên Nhân Viên</th>
              <th>Giới Tính</th>
              <th>Ngày Sinh</th>
              <th>Email</th>
              <th style="text-align: center;">Tình Trạng</th>
              <th>Chức Vụ</th>
              <th></th>
              <th></th>
            </thead>
            <tbody>
              @foreach($staff as $key => $value)
              <tr>
                <td>{{$value->MSNV}}</td>
                <td>{{$value->HoTenNV}}</td>
                <td>
                  <?php
                  if($value->GioiTinh==0){
                    echo 'Nữ';
                  }elseif ($value->GioiTinh==1) {
                    echo 'Nam';
                  }else{
                    echo 'Khác';
                  }
                  ?>
                </td>
                <td>{{ $value->Ngay}}/{{ $value->Thang}}/{{ $value->Nam}}</td>
                <td>{{$value->Email}}</td>
                <td style="text-align: center;">
                  <?php
                    if($value->TrangThai ==1)
                      echo '<i class="material-icons" style="color:green;">done</i>';
                    else  
                      echo '<i class="material-icons" style="color:red;">clear</i>';
                  ?>
                </td>
                <td>{{$value->ChucVu}}</td>
                <td>
                  @if($value->TrangThai==0)
                  <a href="{{URL::to('/unblock_staff/'.$value->MSNV)}}" onclick="return confirm('Bạn có chắc chắn muốn mở khoá tài khoản')"><i class="material-icons">lock_open</i></a>
                  @endif
                </td>
                <td>
                  <a href="{{URL::to('/delete_staff/'.$value->MSNV)}}" onclick="return confirm('Bạn có chắc chắn muốn khoá tài khoản')">
                    <i class="material-icons">lock</i>
                  </a>
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

@endsection
