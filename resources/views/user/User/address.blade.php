@extends('welcome')
@section('contend') 

<div class="ogami-breadcrumb">
	<div class="container">
		<ul>
			<li> <a class="breadcrumb-link" href="{{URL::to('/home')}}"> <i class="fas fa-home"></i>Trang Chủ</a></li>
			<li> <a class="breadcrumb-link" href="{{URL::to('/my_account')}}">Tài khoản</a></li>
      {{-- <?php
        
      ?> --}}
		</ul>
	</div>
</div>

<div class="blog-layout">
  <div class="container">
    <div class="row">
      <div class="col-xl-3">
        <div class="blog-sidebar">
          <button class="no-round-btn" id="filter-sidebar--closebtn">Close sidebar</button>
          <div class="blog-sidebar_search">

          </div>
          <div class="blog-sidebar_categories">
            <div class="categories_top mini-tab-title underline">
              <h2 class="title">Tài Khoản Của Tôi</h2>
            </div>
            <div class="categories_bottom">
              <ul>
                <li><a class="category-link" href="{{URL::to('/my_account')}}">Hồ Sơ</a></li>
                <li> <a class="category-link active" href="{{URL::to('/show_address')}}">Địa Chỉ Giao Hàng</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-xl-9">
        <div class="blog-grid_1col">
          <div id="show-filter-sidebar">
            <h5> <i class="fas fa-bars"></i></h5>
          </div>
          <div class="row">
            @foreach($address as $key => $value)
            <div class="col-8">
              <form>
                {{csrf_field() }}
                <div class="blog-block">
                  <div class="blog-text">
                    <div class="blog-credit">
                      <p class="credit date" style="color: black; font-size: 20px;">{{$value['HoTen']}}</p>
                      <p class="credit comment">{{$value['SDT']}}</p>
                    </div>
                    <p class="blog-describe">
                      {{$value['hamlet']}} , {{$value['district']}} , {{$value['province']}}
                    </p>
                    <p class="blog-describe">
                      {{$value['DiaChi']}}
                    </p>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-4">
              <a class="blog-readmore remove_address" data-id="{{$value['MaDC']}}" href="">Xoá</a>
              <a class="blog-readmore update_address" data-id="{{$value['MaDC']}}" data-toggle="modal" data-target="#update_address" href="" >Cập Nhật</a><br><br>
              {{-- <a class="blog-readmore default_address" data-id="{{$value['MaDC']}}" href="">Thiết lập mặc định</a> --}}
            </div>
            @endforeach
            
            <button class="no-round-btn add_address" data-toggle="modal" data-target="#add_address">Thêm Địa Chỉ</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="add_address">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 col-md-12">
              <div class="address">
                <div class="row">
                  <div class="col-12 col-md-10 mx-auto">
                    <h3 class="address-title">THÊM ĐỊA CHỈ</h3>
                    <form>
                      {{csrf_field() }}
                      <div class="row">
                        <div class="col-md-6 col-12">
                         <input class="no-round-input" id="HoTen" type="text" name="HoTen" value="" placeholder="Họ và tên">
                       </div>
                       <div class="col-md-6 col-12">
                        <input class="no-round-input" id="SDT" type="text" name="SDT" value="" placeholder="Số điện thoại">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-12 form-group">
                        <label for="province">Tỉnh/Thành Phố</label>
                        <select class="no-round-input-bg choose province" id="province" name="province">
                          <option>Chọn Tỉnh/Thành Phố</option>
                          @foreach($province as $tp)
                          <option value="{{$tp->matp}}">{{$tp->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-4 col-12 form-group">
                        <label for="district">Quận/Huyện</label>
                        <select class="no-round-input-bg district choose" id="district" name="district" disabled="true">
                          <option>Chọn Quận/Huyện</option>
                        </select>
                      </div>
                      <div class="col-md-4 col-12 form-group">
                        <label for="hamlet">Phường/Xã</label>
                        <select class="no-round-input-bg hamlet" id="hamlet" name="hamlet" disabled="true">
                          <option>Chọn Phường/Xã</option>
                        </select>
                      </div>
                    </div>
                    <input class="no-round-input" id="DiaChi" type="text" name="DiaChi" value="" placeholder="Địa chỉ cụ thể">
                  </form>
                  <div class="account-function" style="float: right;">
                    <button class="no-round-btn submit-address" name="Them">Thêm</button>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 

  <div class="modal" id="update_address">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 col-md-12">
              <div class="address">
                <div class="row">
                  <div class="col-12 col-md-10 mx-auto">
                    <h3 class="address-title">CẬP NHẬT ĐỊA CHỈ</h3>
                    <form action="{{URL::to('/update_address')}}" method="post">
                      {{csrf_field()}}
                      <div class="row">
                        <div class="col-md-6 col-12">
                           <input class="no-round-input" id="HoTenKH" type="text" name="HoTen" value="" placeholder="Họ và tên">
                        </div>
                        <div class="col-md-6 col-12">
                          <input class="no-round-input" id="SDTKH" type="text" name="SDT" value="" placeholder="Số điện thoại">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4 col-12 form-group">
                          <label for="province">Tỉnh/Thành Phố</label>
                          <select class="no-round-input-bg province update_pro" id="update_province" name="province">
                            <option>Chọn</option>
                            @foreach($province as $tp)
                              <option value="{{$tp->matp}}">{{$tp->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-4 col-12 form-group">
                          <label for="district">Quận/Huyện</label>
                          <input type="hidden" id="id_district">
                          <select class="no-round-input-bg district update_pro" id="update_district" name="district">
                            <option>Chọn</option>
                          </select>
                        </div>
                        <div class="col-md-4 col-12 form-group">
                          <label for="hamlet">Phường/Xã</label>
                           <input type="hidden" id="id_hamlet">
                          <select class="no-round-input-bg hamlet" id="update_hamlet" name="hamlet">
                            <option>Chọn</option>
                          </select>
                        </div>
                      </div>

                      <input class="no-round-input" id="DiaChiKH" type="text" name="DiaChi" value="" placeholder="Địa chỉ cụ thể">
                      <input class="no-round-input" id="MaDC" type="hidden" name="MaDC" value="">
                      
                      <div class="account-function">
                        <button class="no-round-btn" type="submit" name="Them">Cập Nhật
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 



</div>

<script type="text/javascript">
   $(document).ready(function() {

    $('.update_pro').change(function(event) {
      var action = $(this).attr('id');
      var maid = $(this).val();
      var _token = $('input[name="_token"]').val();
      var result ='';
      if(action == 'update_province'){
        result ='update_district';
      }else{
        result = 'update_hamlet';
      }

      $.ajax({
          url: '{{url('/select_update_delivery')}}',
          method: 'POST',
          data:{
            action: action,
            maid: maid,
            _token:_token},
            success:function(data){
              $('#'+result).html(data);
              $("#"+result).prop( "disabled", false );
            }
        });

    });

   });
</script>
@endsection