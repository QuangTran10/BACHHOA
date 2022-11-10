@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <div class="card ">
        <div class="card-header card-header-rose card-header-text">
          <div class="card-text">
            <h4 class="card-title">CẬP NHẬT MÃ GIẢM GIÁ</h4>
          </div>
        </div>
        <div class="card-body ">
          <form method="post" action="{{(route('coupon.update',$coupon->MaGG))}}" class="form-horizontal">
            {{csrf_field() }}
            @method('PUT')
            <div class="row">
              <label class="col-sm-2 col-form-label">Tiêu đề</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="TieuDe" value="{{$coupon->TieuDe}}">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Mã Giảm Gia</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="Ma" value="{{$coupon->Ma}}">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Loại giảm</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <select class="selectpicker" data-style="select-with-transition" name="LoaiGiam">
                    <option>Chọn</option>
                    <option value="1" {{ ($coupon->LoaiGiam=="1")? "selected" : "" }}>Giảm Theo Phần Trăm</option>
                    <option value="2" {{ ($coupon->LoaiGiam=="2")? "selected" : "" }}>Giảm Theo Tiền</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Mức giảm</label>
              <div class="col-sm-10">
                <div class="form-group">
                  @if($coupon->LoaiGiam==1)
                  <input type="number" class="form-control" min="1" max="100" name="MucGiam" value="{{$coupon->MucGiam}}">
                  @elseif($coupon->LoaiGiam==2)
                  <input type="number" class="form-control" min="1000" name="MucGiam" value="{{$coupon->MucGiam}}">
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Ngày hết hạn</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control datepicker" name="NgayKetThuc" value="{{$coupon->NgayKetThuc}}">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Trạng Thái</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <select class="selectpicker" data-style="select-with-transition" name="TrangThai">
                    <option value="1" {{ ($coupon->TrangThai=="1")? "selected" : "" }}>Hiện</option>
                    <option value="0" {{ ($coupon->TrangThai=="0")? "selected" : "" }}>Ẩn</option>
                  </select>
                </div>
              </div>
            </div>
            <a href="{{route('coupon.index')}}" class="btn btn-primary">Trở Về</a>
            <button type="submit" class="btn btn-primary pull-right" name="update">Cập Nhật</button>
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
