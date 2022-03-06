@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <div class="card ">
        <div class="card-header card-header-rose card-header-text">
          <div class="card-text">
            <h4 class="card-title">THÊM DANH MỤC CON</h4>
          </div>
        </div>
        <div class="card-body ">
          <form method="post" action="{{URL::to('/save_catechild')}}" class="form-horizontal">
            {{csrf_field() }}
            <div class="row">
              <label class="col-sm-2 col-form-label">Tên Danh Mục Con</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="TenDanhMuc">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Danh Mục Thuộc</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <select class="selectpicker" data-style="select-with-transition" name="MaLoai">
                    @foreach($all_category as $key => $value_cate)
                      <option value="{{$value_cate->MaLoai}}">{{$value_cate->TenLoai}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <a href="{{URL::to('/catechild_management')}}" class="btn btn-primary">Trở Về</a>
            <button type="submit" class="btn btn-primary pull-right" name="add">Thêm</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
