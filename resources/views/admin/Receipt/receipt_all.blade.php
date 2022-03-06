@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <a href="{{URL::to('/add_receipt')}}" class="btn btn-primary btn-lg" role="button" aria-disabled="true">
         <i class="material-icons">edit</i> Thêm Phiếu Thu
      </a>
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
              <th width="10%">Mã Phiếu</th>
              <th width="15%">Người Lập</th>
              <th width="15%">Thành Tiền</th>
              <th width="15%">Ngày Lập</th>
              <th width="20%">Nhà Cung Cấp</th>
              <th style="text-align: center;" width="20%">Tình Trạng</th>
              <th width="5%"></th>
              <th width="5%"></th>
            </thead>
            <tbody>
              @foreach($all_receipt as $key => $value)
              <tr>
                <td>{{$value->MaPhieu}}</td>
                <td>{{$value->NguoiNP}}</td>
                <td>{{number_format($value->ThanhTien , 0, ',', ' ').'đ';}}</td>
                <td>{{$value->NgayLap}}</td>
                <td>{{$value->NCC}}</td>
                <td style="text-align: center;">
                  <?php
                    if($value->TinhTrang ==0)
                      echo 'Chưa Thanh Toán';
                    else  
                      echo 'Đã Thanh Toán';
                  ?>
                </td>
                <td>
                  <a href="{{-- {{URL::to('/update_product/'.$value->MSHH)}} --}}"><i class="material-icons">edit</i></a>
                </td>
                <td>
                  <a href="{{-- {{URL::to('/delete_product/'.$value->MSHH.'/'.$value->hinhanh1)}} --}}" onclick="return confirm('Bạn có chắc chắn muốn xoá')">
                    <i class="material-icons">delete</i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div style="text-align: center;">

          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
