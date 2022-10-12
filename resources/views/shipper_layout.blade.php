<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('public/backend/shipper/images/shipping_icon.png')}}">
  <link rel="icon" href="{{asset('public/backend/shipper/images/shipping_icon.png')}}">
  <title>Express</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="{{asset('public/backend/shipper/css/materialize.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/shipper/css/loaders.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/shipper/css/lightbox.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="stylesheet" href="{{asset('public/backend/shipper/css/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/shipper/css/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/shipper/css/style.css')}}">

</head>
<body>

  <!-- preloader -->
  <div class="preloader">
    <div class="spinner"></div>
  </div>
  <!-- end preloader -->

  @yield('shipper_header')

  <div class="sidebar-panel">
    <ul id="slide-out" class="collapsible side-nav">
      <li>
        <div class="user-view">
          <div class="background">
            <img src="{{asset('public/backend/shipper/images/default_avatar.jpeg')}}" alt="">
          </div>
          <img class="circle responsive-img" src="{{asset('public/backend/shipper/images/default_avatar.jpeg')}}" alt="">
          <span class="white-text name">John Roe</span>
        </div>
      </li>
      <li><a href="{{URL::to('/dashboard_shipper')}}"><i class="fa fa-home cyan"></i>Trang Chủ</a></</li>
      <li>
      <li>
        <a href="{{URL::to('/shipper_order')}}"><i class="fas fa-file-invoice alizarin"></i>Đơn Hàng</a>
      </li>
      <li><a href="{{URL::to('/shipper_infor')}}"><i class="fa fa-user yellow"></i>Thông Tin Cá Nhân</a></li>
      <li><a href="{{URL::to('/shipper_noti')}}"><i class="fas fa-bell emerald"></i>Thông Báo</a></li>
      <li><a href="{{URL::to('/logout_shipper')}}"><i class="fas fa-sign-in-alt alizarin"></i>Đăng Xuất</a></li>
    </ul>
  </div>
  
  <?php
    $name = Session::get('shipper_name');
  ?>

  <!-- slide -->
  <div class="slide slide-home">
    <div class="slide-show owl-carousel owl-theme">
      <div class="slide-content">
        <div class="mask"></div>
        <img src="{{('public/backend/shipper/images/hochiminh.jpg')}}" alt="">
        <div class="caption text-center">
          <h2>Chào Mừng <span style="color: yellow">{{$name}}</span> Đến Với Express</h2>
        </div>
      </div>
      <div class="slide-content">
        <div class="mask"></div>
        <img src="{{('public/backend/shipper/images/halong.jpg')}}" alt="">
      </div>
      <div class="slide-content">
        <div class="mask"></div>
        <img src="{{('public/backend/shipper/images/danang.jpg')}}" alt="">
      </div>
    </div>
  </div>
  <!-- end slide -->


  @yield('shipper_content')


  <!-- persipura -->
  <div class="persipura">
    <div class="container">
      <div class="jayapura">
        <div class="col s6">
          <div class="content">
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end persipura -->



  <script src="{{asset('public/backend/shipper/js/jquery.min.js')}}"></script>
  <script src="{{asset('public/backend/shipper/js/materialize.js')}}"></script>
  <script src="{{asset('public/backend/shipper/js/numscroller.js')}}"></script>
  <script src="{{asset('public/backend/shipper/js/lightbox.js')}}"></script>
  <script src="{{asset('public/backend/shipper/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('public/backend/shipper/js/main.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  <script type="text/javascript">
  $(document).ready(function(){
    $('select').formSelect();

    // $('.City').change(function(event) {
    //  var city = $('.City').val();

    //  $('#ThanhPho').val(city);
    // });

  });
</script>
</body>
</html>