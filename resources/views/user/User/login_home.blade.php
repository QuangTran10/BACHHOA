@extends('welcome')
@section('contend')  
<div class="ogami-breadcrumb">
  <div class="container">
    <ul>
      <li> <a class="breadcrumb-link" href="{{URL::to('/home')}}"> <i class="fas fa-home"></i>Trang Chủ</a></li>
      <li> <a class="breadcrumb-link active" href="#">Đăng Nhập</a></li>
    </ul>
  </div>
</div>
<!-- End breadcrumb-->
<div class="account">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6 mx-auto">
        <h1 class="title">ĐĂNG NHẬP</h1>
        <form action="{{URL::to('/login')}}" method="post">
          {{ csrf_field() }}
          @if(session('notice'))
          <p style="color: red; text-align: center;">
            {{session('notice')}}
          </p>
          @endif
          <label for="user-name">Email</label>
          <input class="no-round-input" id="Email" name="Email" type="email">
          <label for="password">Mật Khẩu</label>
          <input class="no-round-input" id="Password" name="MatKhau" type="password">
                {{-- <div class="account-method">
                  <div class="account-save">
                    <input id="savepass" type="checkbox">
                    <label for="savepass">Save Password</label>
                  </div>
                  <div class="account-forgot"><a href="#">Forget your Password</a></div>
                </div> --}}
                <div class="account-function">
                  <button class="no-round-btn" type="submit" name="DangNhap">Đăng Nhập</button>
                  <a class="create-account" href="{{URL::to('/register_home')}}">Hoặc Tạo Tài Khoản Mới</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End account-->
      @endsection