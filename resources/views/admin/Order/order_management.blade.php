@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-4 col-md-4">
      @if($count_order_process!=0)
      <div class="alert alert-warning">
        <span>Có {{$count_order_process}} đơn hàng cần xử lý</span>
      </div>
      @endif
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-md-4">
      <form class="navbar-form">
        <div class="input-group no-border">
          <input type="text" value="" class="form-control" placeholder="Tìm kiếm.....">
          <button class="btn btn-white btn-round btn-just-icon">
            <i class="material-icons">search</i>
            <div class="ripple-container"></div>
          </button>
        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Danh sách đơn hàng</h4>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead class="text-warning">
              <th width="10%">Mã Đơn Hàng</th>
              <th width="15%">Tên Khách Hàng</th>
              <th width="10%">SDT</th>
              <th width="20%">Địa Chỉ</th>
              <th width="20%">Ngày Đặt Hàng</th>
              <th width="10%">Trạng Thái</th>
              <th style="text-align: center;" width="10%">Thanh Toán</th>
              <th width="5%"></th>
            </thead>
            <tbody>
              @foreach($all_order as $key => $value)
              <tr <?php if($value->TrangThai ==0) echo 'class="table-danger" ';?>>
                <td>{{$value->MSDH}}</td>
                <td>{{$value->HoTen}}</td>
                <td>{{$value->SDT}}</td>
                <td>{{$value->DiaChi}}</td>
                <td>{{$value->NgayDat}}</td>
                <td>
                  <?php
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
                <td style="text-align: center;">
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
                <td>
                  <a href="{{URL::to('/view_order/'.$value->MSDH)}}"><i class="material-icons">visibility</i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div> {{-- end card body --}}
      </div>
    </div>
  </div>
</div>

@endsection
