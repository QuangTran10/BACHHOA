@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <div class="card ">
        <div class="card-header card-header-rose card-header-text">
          <div class="card-text">
            <h4 class="card-title">CẬP NHẬT NHÀ SẢN XUẤT</h4>
          </div>
        </div>
        <div class="card-body ">
          <form method="post" action="{{(route('producer.update',$producer->MaNCC))}}" class="form-horizontal">
            {{csrf_field() }}
            @method('PUT')
            <div class="row">
              <label class="col-sm-3 col-form-label">Tên NSX</label>
              <div class="col-sm-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="Ten" required value="{{$producer->Ten}}">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-9">
                <div class="form-group">
                  <input type="email" class="form-control" name="Email" required value="{{$producer->Email}}">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-3 col-form-label">Địa Chỉ</label>
              <div class="col-sm-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="DiaChi" required value="{{$producer->DiaChi}}">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-3 col-form-label">Số Điện Thoại</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="SDT" required value="{{$producer->SDT}}">
              </div>
            </div>
            <a href="{{route('producer.index')}}" class="btn btn-primary">Trở Về</a>
            <button type="submit" class="btn btn-primary pull-right" name="update">Cập Nhật</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
