@extends('welcome')
@section('contend')  
<div class="ogami-breadcrumb">
        <div class="container">
          <ul>
            <li> <a class="breadcrumb-link" href="{{URL::to('/home')}}"> <i class="fas fa-home"></i>Trang Chủ</a></li>
            <li> <a class="breadcrumb-link active" href="#">Đăng Ký</a></li>
          </ul>
        </div>
      </div>
      <!-- End breadcrumb-->
      <div class="account">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-6 mx-auto">
              <h1 class="title">ĐĂNG KÝ</h1>
              <form action="{{URL::to('/register')}}" method="post" id="Register">
                {{csrf_field() }}
                <label for="HoTenKH">Họ Tên</label>
                <input class="no-round-input" id="HoTenKH" type="text" name="HoTenKH">
                <label for="sex">Giới Tính</label>
                <div id="Gender">
                  <input name="GioiTinh" type="radio" value="0"> Nam
                  <input name="GioiTinh" type="radio" value="1"> Nữ
                  <input name="GioiTinh" type="radio" value="2"> Khác
                </div>
                <label for="birthday">Ngày Sinh</label>
                <input class="no-round-input" id="NgaySinh" name="NgaySinh" type="date">
                <label for="SDT">Số Điện Thoại</label>
                <input class="no-round-input" id="SDT" name="SDT" type="text">
                <label for="Email">Email</label>
                <input class="no-round-input" id="Email" name="Email" type="email">
                <label for="MatKhau">Mật Khẩu</label>
                <input class="no-round-input" id="MatKhau" name="MatKhau" type="password">
                <label for="MatKhau1">Nhập Lại Mật Khẩu</label>
                <input class="no-round-input" id="MatKhau1" name="MatKhau1" type="password">
                <div class="account-function">
                  <button class="no-round-btn" type="submit" name="DangKi">Đăng Ký</button>
                  <a class="create-account" href="{{URL::to('/login_home')}}">Hoặc Đăng Nhập</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End account-->

  <script type="text/javascript">
    $(document).ready(function() {
      jQuery.validator.addMethod("phoneVN", function(value, element) {
            // allow any non-whitespace characters as the host part
            return this.optional( element ) || /^(0){1}[0-9]{9,10}$/.test( value );
        }, 'Số điện thoại không hợp lệ.');
      $( "#Register" ).validate({
        rules: {
          HoTenKH: {
            required: true
          },
          Email:{
            required: true,
            email: true
          },
          MatKhau:{
            required: true,
            minlength: 8
          },
          MatKhau1:{
            required: true,
            equalTo: "#MatKhau"
          },
          SDT:{
            required: true,
            phoneVN: true
          },
          NgaySinh:{
            required: true
          },
          GioiTinh:{
            required: true
          },
        },
        messages: {
          HoTenKH: "Họ Tên không được để trống",
          Email:{
            required: "Email không để trống",
            email: "Không phải email"
          },
          MatKhau:{
            required: "Mật khẩu không để trống",  
            minlength: "Mật Khẩu phải ít nhất 8 ký tự"
          },
          MatKhau1:{
            required: "Không để trống",
            equalTo: "Nhập lại mật khẩu không đúng"
          },
          SDT:{
            required: "Số điện thoại không để trống"
          },
          NgaySinh:{
            required: "Ngày sinh không được bỏ trống"
          },
          GioiTinh:{
            required: "Giới tính không được bỏ trống"
          },
        },
        //Hàm in lỗi ở cuối 1 thẻ nào đó
        errorPlacement: function(error, element) 
        {
          if ( element.is(":radio") ) 
          {
            error.appendTo( element.parents('#Gender') );
          }
          else 
          { // This is the default behavior 
            error.insertAfter( element );
          }
        },


      });
    });
  </script>

@endsection