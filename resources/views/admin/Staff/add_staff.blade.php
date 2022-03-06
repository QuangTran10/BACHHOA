@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <div class="card ">
        <div class="card-header card-header-rose card-header-text">
          <div class="card-text">
            <h4 class="card-title">THÊM NHÂN VIÊN MỚI</h4>
          </div>
        </div>
        <div class="card-body ">
          <form method="post" action="{{URL::to('/save_staff')}}" class="form-horizontal">
            {{csrf_field() }}
            <div class="form-group">
              <label class="bmd-label-floating">Tên Nhân Viên</label>
              <input type="text" class="form-control" name="HoTenNV">
            </div>
            
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Giới Tính </label><br>
                  <select class="selectpicker" data-style="select-with-transition" name="GioiTinh">
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                    <option value="2">Khác</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Chức Vụ</label><br>
                  <select class="selectpicker" data-style="select-with-transition" data-size="7" name="ChucVu">
                    <option value="Nhân Viên">Nhân Viên</option>
                    <option value="Kế Toán">Kế Toán</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="bmd-label-floating">Email</label>
              <input type="email" class="form-control" name="Email">
            </div>
            <div class="form-group">
              <label class="bmd-label-floating">Địa Chỉ</label>
              <input type="text" class="form-control" name="DiaChi">
            </div>
            <div class="form-group">
              <label class="bmd-label-floating">Số Điện Thoại</label>
              <input type="text" class="form-control" name="SDT">
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="bmd-label-floating">Ngày</label>
                  <select class="selectpicker" data-style="select-with-transition" multiple title="Chọn" data-size="7" name="Ngay">
                     @for($i = 1; $i < 31; $i++)
                          <option value="{{$i}}">{{$i}}</option>
                     @endfor
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="bmd-label-floating">Tháng</label>
                  <select class="selectpicker" data-style="select-with-transition" multiple title="Chọn" data-size="7" name="Thang">
                    @for($i = 1; $i < 12; $i++)
                          <option value="{{$i}}">{{$i}}</option>
                     @endfor
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="bmd-label-floating">Năm</label>
                  <select class="selectpicker" data-style="select-with-transition" multiple title="Chọn" data-size="7" name="Nam">
                    <?php
                    $date = getdate();
                    for ($i=1990; $i <=$date['year'] ; $i++) { 
                    ?>
                      <option value="<?php echo $i?>"><?php echo $i?></option>
                    <?php        
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <a href="{{URL::to('/staff_management')}}" class="btn btn-primary">Trở Về</a>
            <button type="submit" class="btn btn-primary pull-right" name="add">Thêm</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
