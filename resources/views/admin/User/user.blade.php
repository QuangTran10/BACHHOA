@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  @foreach($staff_infor as $key => $value)
  <form method="post" action="{{URL::to('/update_user')}}" enctype="multipart/form-data">
    {{csrf_field() }}
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">THÔNG TIN CÁ NHÂN</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Họ Tên</label>
                  <input type="text" class="form-control" name="HoTen" value="{{ $value->HoTenNV}}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Email</label>
                  <input type="email" class="form-control" name="Email" value="{{ $value->Email}}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Địa Chỉ Liên Hệ</label>
                  <input type="text" class="form-control" name="DiaChi" value="{{ $value->DiaChi}}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Giới Tính </label>
                  <div class="form-check form-check-radio form-check-inline">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="GioiTinh" id="inlineRadio1" value="1" {{ ($value->GioiTinh=="1")? "checked" : "" }}> Nam
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check form-check-radio form-check-inline">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="GioiTinh" id="inlineRadio2" value="0" {{ ($value->GioiTinh=="0")? "checked" : "" }}> Nữ
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check form-check-radio form-check-inline">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="GioiTinh" id="inlineRadio3" value="2" {{ ($value->GioiTinh=="2")? "checked" : "" }}> Khác
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Số Điện Thoại</label>
                  <input type="text" class="form-control" name="SDT" value="{{ $value->SDT}}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="bmd-label-floating">Ngày</label>
                  <select class="selectpicker" data-style="select-with-transition" multiple title="Chọn" data-size="7" name="Ngay">
                   @for($i = 1; $i < 31; $i++)
                   <option value="{{$i}}" {{ ($value->Ngay==$i)? "selected" : "" }}>
                    {{$i}}
                  </option>
                  @endfor
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="bmd-label-floating">Tháng</label>
                <select class="selectpicker" data-style="select-with-transition" multiple title="Chọn" data-size="7" name="Thang">
                  @for($i = 1; $i < 12; $i++)
                  <option value="{{$i}}" {{ ($value->Thang==$i)? "selected" : "" }}>
                    {{$i}}
                  </option>
                  @endfor
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="bmd-label-floating">Năm</label>
                <select class="selectpicker" data-style="select-with-transition" multiple title="Chọn" data-size="7" name="Nam">
                  @for($i = 1990; $i < 2021; $i++)
                  <option value="{{$i}}" {{ ($value->Nam==$i)? "selected" : "" }}>
                    {{$i}}
                  </option>
                  @endfor
                </select>
              </div>
            </div>
          </div>    
          <button type="submit" class="btn btn-primary pull-right" name="Update">Cập Nhật Thông Tin</button>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-profile">
        <div class="card-avatar">
          <a href="">
            <img class="img" src="{{('public/backend/images/avatar/'.$value->Avatar)}}" />
          </a>
        </div>
        <div class="card-body">
          <h6 class="card-category">{{ $value->ChucVu}}</h6>
          <h4 class="card-title">{{ $value->HoTenNV}}</h4>
          <p class="card-text">{{ $value->Ngay}}/{{ $value->Thang}}/{{ $value->Nam}}</p>
          <div class="fileinput fileinput-new text-center" data-provides="fileinput">
            <div class="fileinput-preview fileinput-exists thumbnail"></div>
            <div>
              <span class="btn btn-rose btn-round btn-file">
                <span class="fileinput-new">Cập Nhật Ảnh Đại Diện</span>
                <span class="fileinput-exists">Change</span>
                <input type="file" name="Avatar" />
              </span>
              <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form> 
@endforeach 
</div>
@endsection
