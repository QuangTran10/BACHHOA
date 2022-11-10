@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <div class="card ">
        <div class="card-header card-header-rose card-header-text">
          <div class="card-text">
            <h4 class="card-title">THÊM MÃ GIẢM GIÁ</h4>
          </div>
        </div>
        <div class="card-body ">
          <form method="post" action="{{(route('coupon.store'))}}" class="form-horizontal" id="add_coupon">
            {{csrf_field() }}
            <div class="row">
              <label class="col-sm-2 col-form-label">Tiêu đề</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="TieuDe" id="TieuDe" required>
                  <p class="help is-danger">{{ $errors->first('TieuDe') }}</p>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Mã Giảm Giá</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="Ma" value="<?php echo strtoupper(substr(md5(time()), 0, 12))?>" required >
                  <p class="help is-danger">{{ $errors->first('Ma') }}</p>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Loại giảm</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <select class="selectpicker" data-style="select-with-transition" id="LoaiGiam" name="LoaiGiam" required >
                    <option value="">Chọn</option>
                    <option value="1">Giảm Theo Phần Trăm</option>
                    <option value="2">Giảm Theo Tiền</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Mức giảm</label>
              <div class="col-sm-10">
                <div class="form-group" id="content-price">
                  
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Ngày hết hạn</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control datepicker" id="NgayKetThuc" name="NgayKetThuc" required>
                  <p class="help is-danger">{{ $errors->first('NgayKetThuc') }}</p>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Trạng Thái</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <select class="selectpicker" id="TrangThai" data-style="select-with-transition" name="TrangThai" required>
                    <option value="1">Hiện</option>
                    <option value="0">Ẩn</option>
                  </select>
                  <p class="help is-danger">{{ $errors->first('TrangThai') }}</p>
                </div>
              </div>
            </div>
            <a href="{{route('coupon.index')}}" class="btn btn-primary">Trở Về</a>
            <button type="submit" class="btn btn-primary pull-right" name="add">Thêm</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {

    $(function () {
      $('.datepicker').datetimepicker({
        format:'YYYY-MM-DD'
      });
    });

    $('#LoaiGiam').change(function(event) {
      var type = $(this).val();
      if(type==1){
        $('#content-price').empty();
        $('#content-price').append('<input type="number" class="form-control" min="1" max="100" name="MucGiam" id="MucGiam" required><p class="help is-danger">{{ $errors->first('MucGiam') }}</p>');
      }else if(type==2){
        $('#content-price').empty();
        $('#content-price').append('<input type="number" class="form-control" min="1000" name="MucGiam" id="MucGiam" required><p class="help is-danger">{{ $errors->first('MucGiam') }}</p>');
      }
      
    });


  });
</script>
@endsection
