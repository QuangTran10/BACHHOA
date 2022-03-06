@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <div class="card ">
        <div class="card-header card-header-rose card-header-text">
          <div class="card-text">
            <h4 class="card-title">CẬP NHẬT SẢN PHẨM</h4>
          </div>
        </div>
        <div class="card-body ">
          @foreach($all_product as $key => $value_pro)
          <form method="post" action="{{URL::to('/edit_product/'.$value_pro->MSSP)}}" class="form-horizontal" enctype="multipart/form-data" id="UpdateProduct">
            {{csrf_field() }}
            <div class="row">
              <label class="col-sm-2 col-form-label">Tên Hàng Hoá</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="TenHangHoa" value="{{$value_pro->TenSP}}" id="TenSP">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Giá</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="Gia" value="{{$value_pro->Gia}}" id="Gia">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Số Lượng</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="number" class="form-control" name="SoLuong" min="1" value="{{$value_pro->SoLuong}}" id="SoLuongHang">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Danh Mục Hàng</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="DanhMuc">
                    @foreach($category as $key => $value_cate)
                      @if($value_cate->MaDM == $value_pro->MaDM)
                        <option value="{{$value_cate->MaDM}}" selected>{{$value_cate->TenDanhMuc}}</option>
                      @else
                        <option value="{{$value_cate->MaDM}}">{{$value_cate->TenDanhMuc}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Trạng Thái</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <select class="selectpicker" data-style="select-with-transition" name="TrangThai">
                    <option value="1" {{ ($value_pro->TrangThai=="1")? "selected" : "" }}>Hiện</option>
                    <option value="0" {{ ($value_pro->TrangThai=="0")? "selected" : "" }}>Ẩn</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Giảm Giá (%)</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <select class="selectpicker" data-style="select-with-transition" name="GiamGia">
                    <option value="0" {{($value_pro->GiamGia=="0")? "selected" : "" }}>0%</option>
                    <?php
                      for ($i=1; $i <=10; $i++) { 
                        $a=0.1*$i;
                    ?>
                    <option value="<?php echo $a;?>" {{($value_pro->GiamGia==$a)? "selected" : "" }}>
                      <?php echo ($a*100).'%';?>
                    </option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Thông Tin</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <textarea class="form-control" name="ThongTin" rows="6" id="ckediter1">{{$value_pro->ThongTin}}</textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 col-sm-4"></div>
              <div class="col-md-4 col-sm-4">
                <h4 class="title text-center"><b>Hình Ảnh</b></h4>
                <p class="title text-center"><i>Có thể chọn nhiều hình ảnh. Chỉ có thể thêm ảnh cho sản phẩm</i></p>
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                  <div class="fileinput-new thumbnail">
                    <img src="{{asset('public/backend/assets/img/image_placeholder.jpg')}}" alt="...">
                  </div>
                  <div class="fileinput-preview fileinput-exists thumbnail"></div>
                  <div>
                    <span class="btn btn-rose btn-round btn-file">
                      <span class="fileinput-new">Chọn Hình Ảnh</span>
                      <span class="fileinput-exists">Thay Đổi</span>
                      <input type="file" name="HinhAnh[]" multiple/>
                    </span>
                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Xoá</a>
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" name="created_at" value="{{$value_pro->created_at}}">
            <a href="{{URL::to('/product_management')}}" class="btn btn-primary">Trở Về</a>
            <button type="submit" class="btn btn-primary pull-right" name="add">Cập Nhật</button>
          </form>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    CKEDITOR.replace( 'ckediter1');
    $( "#UpdateProduct" ).validate({
      rules: {
        TenHangHoa: {
          required: true
        },
        Gia:{
          required: true,
          number: true,
          digits: true
        },
        SoLuong:{
          required: true,
        },
      },
      messages: {
        TenHangHoa: "Tên hàng hoá không được để trống",
        Gia:{
          required: "Giá không để trống",
          number: "Giá phải là số",
          digits: "Giá không là số âm"
        },
        SoLuong:{
          required: "Số lượng không bỏ trống",
        },
      }
    });
  });
</script>

@endsection
