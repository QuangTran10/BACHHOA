@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <form method="post" action="{{URL::to('/save_receipt')}}" class="form-horizontal">
        {{csrf_field() }}
        <div class="card ">
          <div class="card-header card-header-rose card-header-text">
            <div class="card-text">
              <h4 class="card-title">PHIẾU THU</h4>
            </div>
          </div>
          <div class="card-body ">

            <p>
              <?php
              $message = Session::get('message');
              if($message){
                echo $message;
                Session::put('message',null);
              }
              ?>
            </p>
            <div class="form-group">
              <label class="bmd-label-floating">Ghi Chú</label>
              <textarea class="form-control" name="GhiChu" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label class="bmd-label-floating">Nhà Cung Cấp</label>
              <div class="form-group">
                <select class="selectpicker" data-style="select-with-transition" name="MaNCC" required>
                  @foreach($producer as $key => $val)
                  <option value="{{$val->MaNSX}}">{{$val->Ten}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            {{-- <div class="row">
              <div class="form-group col-12">
                <label >Danh Sách Sản Phẩm</label>
                @foreach($product as $key => $value)
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="sp[{{$value->MSSP}}]" value="{{$value->MSSP}}">{{$value->TenSP}}
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                @endforeach
              </div>
            </div> --}}
            
          </div>
        </div>

        <div class="card ">
          <div class="card-body ">

            {{-- <div class="row">
              <div class="form-group col-12">
                <label >Danh Sách Sản Phẩm</label>
                @foreach($product as $key => $value)
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="sp[{{$value->MSSP}}]" value="{{$value->MSSP}}">{{$value->TenSP}}
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                @endforeach
              </div>
            </div> --}}
            
          </div>
        </div>
        <div class="card ">
          <div class="card-body ">

            {{-- <div class="row">
              <div class="form-group col-12">
                <label >Danh Sách Sản Phẩm</label>
                @foreach($product as $key => $value)
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="sp[{{$value->MSSP}}]" value="{{$value->MSSP}}">{{$value->TenSP}}
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                @endforeach
              </div>
            </div> --}}
            
          </div>
        </div>

        <a href="{{URL::to('/show_receipt')}}" class="btn btn-primary">Trở Về</a>
        <button type="submit" class="btn btn-primary pull-right" name="add">Thêm</button>
      </form>
    </div>
  </div>
</div>

@endsection
