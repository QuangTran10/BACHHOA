@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <div class="card ">
        <div class="card-header card-header-rose card-header-text">
          <div class="card-text">
            <h4 class="card-title">THÊM NHÀ SẢN XUẤT</h4>
          </div>
        </div>
        <div class="card-body ">
          @foreach($edit_category_child as $key => $value)
          <form method="post" action="{{URL::to('/edit_catechild/'.$value->MaDM)}}" class="form-horizontal">
            {{csrf_field() }}
            
            <div class="row">
              <label class="col-sm-2 col-form-label">Tên Danh Mục Con</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="TenDanhMuc" value="{{$value->TenDanhMuc}}">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Danh Mục Thuộc Về</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <select class="selectpicker" data-style="select-with-transition" name="MaLoai" >
                    @foreach($category as $key => $value_cate)
                      @if($value_cate->MaLoai == $value->MaLoai)
                        <option value="{{$value_cate->MaLoai}}" selected>{{$value_cate->TenLoai}}</option>
                      @else
                        <option value="{{$value_cate->MaLoai}}">{{$value_cate->TenLoai}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <a href="{{URL::to('/catechild_management')}}" class="btn btn-primary">Trở Về</a>
            <button type="submit" class="btn btn-primary pull-right" name="add">Cập Nhật</button>
          </form>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
