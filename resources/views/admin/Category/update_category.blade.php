@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <div class="card ">
        <div class="card-header card-header-rose card-header-text">
          <div class="card-text">
            <h4 class="card-title">THÊM DANH MỤC</h4>
          </div>
        </div>
        <div class="card-body ">
          <form method="post" action="{{URL::to('/edit_category/'.$edit_category_product->MaLoai)}}" class="form-horizontal">
            {{csrf_field() }}
            
            <div class="row">
              <label class="col-sm-2 col-form-label">Tên Danh Mục</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="TenLoai" value="{{$edit_category_product->TenLoai}}">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Tình Trạng</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <select class="selectpicker" data-style="select-with-transition" name="TrangThai" >
                    <option value="1" {{ ($edit_category_product->TrangThai=="1")? "selected" : "" }}>Hiện</option>
                    <option value="0" {{ ($edit_category_product->TrangThai=="0")? "selected" : "" }}>Ẩn</option>
                  </select>
                </div>
              </div>
            </div>
            <a href="{{URL::to('/category_management')}}" class="btn btn-primary">Trở Về</a>
            <button type="submit" class="btn btn-primary pull-right" name="add">Cập Nhật</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
