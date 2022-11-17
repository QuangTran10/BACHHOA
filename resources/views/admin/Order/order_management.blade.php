@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-3 col-md-6">
      @if($count_order_process!=0)
      <div class="alert alert-warning">
        <span>Có {{$count_order_process}} đơn hàng cần xử lý</span>
      </div>
      @endif
    </div>
    <div class="col-lg-5 col-md-6">
      @if($count_order_ship != 0)
      <div class="alert alert-warning">
        <span>Có {{$count_order_ship}} đơn hàng cần chọn nhân viên giao hàng</span>
      </div>
      @endif
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary card-header-icon">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title">Danh sách đơn hàng</h4>
        </div>
        <div class="card-body">
          <div class="toolbar">
            
          </div>
          <div class="material-datatables">
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
              <thead>
                <tr>
                  <th width="10%">Mã DH</th>
                  <th width="15%">Tên Khách Hàng</th>
                  <th width="10%">SDT</th>
                  <th width="20%">Địa Chỉ</th>
                  <th width="20%">Ngày Đặt Hàng</th>
                  <th width="10%">Trạng Thái</th>
                  <th style="text-align: center;" width="10%">Thanh Toán</th>
                  <th width="5%"></th>
                </tr>
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

                    if($value->TrangThai ==0){
                      echo 'Đang Xử Lý';
                    }elseif($value->TrangThai == 1){
                      echo 'Chờ Lấy Hàng';
                    }elseif($value->TrangThai ==2){
                      echo 'Nhận Đơn';
                    }elseif($value->TrangThai ==3){
                      echo 'Đang Giao Hàng';
                    }elseif($value->TrangThai ==4){
                      echo 'Giao Hàng Thành Công';
                    }elseif($value->TrangThai ==6){
                      echo 'Đã Huỷ';
                    }elseif ($value->TrangThai == 7) {
                      echo 'Trả Hàng';
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
      order: [[0, 'desc']],
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Tìm kiếm đơn hàng",
        "paginate": {
          "previous": "<<",
          "next": ">>"
        },
        "lengthMenu": "Hiển thị _MENU_",
        "info": "Hiển thị từ _START_ đến _END_ của _TOTAL_ đơn hàng",
      }
    });

    var table = $('#datatable').DataTable();

  });
</script>
@endsection
