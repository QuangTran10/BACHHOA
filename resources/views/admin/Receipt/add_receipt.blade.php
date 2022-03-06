@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <div class="card ">
        <div class="card-header card-header-rose card-header-text">
          <div class="card-text">
            <h4 class="card-title">PHIẾU THU</h4>
          </div>
        </div>
        <div class="card-body ">
          <form method="post" action="{{URL::to('/save_receipt')}}" class="form-horizontal">
            {{csrf_field() }}
            <p>
              <?php
                $message = Session::get('message');
                if($message){
                  echo $message;
                  Session::put('message',null);
                }
              ?>
            </p>
            <div class="row">
              <label class="col-sm-3 col-form-label">Ghi Chú</label>
              <div class="col-sm-9">
                <div class="form-group">
                  <textarea class="form-control" name="GhiChu" rows="6"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-3 col-form-label">Nhà Cung Cấp</label>
              <div class="col-sm-9">
                <div class="form-group">
                  <input type="text" class="form-control" name="NCC" required="">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-3 col-form-label label-checkbox">Danh Sách Sản Phẩm</label>
              <div class="col-sm-9 col-sm-offset-1 checkbox-radios">
                @foreach($all_product as $key => $value)
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="sp[{{$value->MSHH}}]" value="{{$value->MSHH}}">{{$value->TenHH . " - " . $value->MaNSX}}
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                @endforeach
              </div>
            </div>
            <a href="{{URL::to('/show_receipt')}}" class="btn btn-primary">Trở Về</a>
            <button type="submit" class="btn btn-primary pull-right" name="add">Thêm</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
