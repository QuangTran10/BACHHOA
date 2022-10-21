@extends('shipper_layout')
@section('shipper_content')
	
	<!-- menu -->
  <div class="menu segments">
    <div class="container">
      <div class="row">
        <div class="col s4">
          <a href="{{URL::to('/dashboard_shipper')}}">
            <div class="icon">
              <i class="fa fa-home cyan"></i>
            </div>
            Trang Chủ
          </a>
        </div>
        <div class="col s4">
          <a href="{{URL::to('/shipper_order')}}">
            <div class="icon">
              <i class="fas fa-file-invoice"></i>
            </div>
            Đơn Hàng
          </a>
        </div>
        <div class="col s4">
          <a href="">
            <div class="icon">
              <i class="fas fa-shipping-fast emerald"></i>
            </div>
            Đã Giao Hàng
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col s4">
          <a href="{{URL::to('/shipper_noti')}}" class="notification">
            <i class="fas fa-bell"></i>
            <div class="badge">
              <span>+90</span>
            </div>
          </a>
          <p class="tittle">Thông Báo</p>
        </div>
        <div class="col s4">
          <a href="{{URL::to('/shipper_infor')}}">
            <div class="icon">
              <i class="fa fa-user yellow"></i>
            </div>
            Thông Tin Cá Nhân
          </a>
        </div>
        <div class="col s4">
          <a href="{{URL::to('/logout_shipper')}}">
            <div class="icon">
              <i class="fas fa-sign-in-alt"></i>
            </div>
            Đăng Xuất
          </a>
        </div>
      </div>
     
    </div>
  </div>
  <!-- end menu -->

@endsection