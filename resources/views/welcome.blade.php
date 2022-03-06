<!DOCTYPE html>
<html lang="en">
  <head>
    <title>BACHHOA.COM</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <meta name="author" content="Louis Tran">
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link  rel="canonical" href="{{$url}}" />
    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/custom_bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/elegant.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/scroll.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/assets/css/jquery.fancybox.min.css')}}">
    <link href="{{asset('public/frontend/assets/css/sweetalert.css')}}" rel="stylesheet">
    <script src="{{asset('public/frontend/assets/js/jquery-3.6.0.js')}}"></script>
    <link rel="shortcut icon" href="{{asset('public/frontend/assets/images/shortcut_logo.png')}}">
  </head>
  <body>
    <div id="main">
      <header>
        <div class="header-block d-flex align-items-center">
          <div class="ogami-container-fluid">
            <div class="row">
              <div class="col-12 col-md-6">
                <div class="header-left d-flex flex-column flex-md-row align-items-center">
                  <p class="d-flex align-items-center"><i class="fas fa-envelope"></i>qtran8219@gmail.com</p>
                  <p class="d-flex align-items-center"><i class="fas fa-phone"></i>+84 859083181</p>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="header-right d-flex flex-column flex-md-row justify-content-md-end justify-content-center align-items-center">
                  <div class="login d-flex">
                      <?php
                      $name_user= Session::get('user_name');
                      if($name_user){
                      ?>  
                      <div class="language">
                        <div class="selected-language"><i class="fas fa-user"></i>&nbsp;<?php echo $name_user; ?>
                          <ul class="list-language">
                            <li><a href="{{URL::to('/my_account')}}"><i class="fas fa-user"></i>Tài Khoản Của Tôi</a></li>
                            <li><a href="{{URL::to('/show_order')}}"><i class="fas fa-shopping-bag"></i> Quản Lý Đơn Hàng</a></li>
                          </ul>
                        </div>
                      </div>
                      <?php  
                      }else{
                      ?>  
                        <a href="{{URL::to('/login_home')}}"><i class="fas fa-user"></i> Đăng Nhập</a>
                      <?php  
                      }
                      ?>
                  </div>
                  <div class="login d-flex">
                    <?php
                    if($name_user){
                    ?>
                    <a href="{{URL::to('/logout_user')}}">&nbsp;&nbsp;&nbsp;<i class="fas fa-sign-out-alt"></i></a>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="mobile-menu">
          <div class="container">
            <div class="row">
              <div class="col-3">
                <div class="mobile-menu_block d-flex align-items-center"><a class="mobile-menu--control" href="#"><i class="fas fa-bars"></i></a>
                  <div id="ogami-mobile-menu">
                    <button class="no-round-btn" id="mobile-menu--closebtn">Close menu</button>
                    <div class="mobile-menu_items">
                      <ul class="mb-0 d-flex flex-column">
                        <li class="toggleable"> <a class="menu-item active" href="">Trang Chủ</a></li>
                        <li class="toggleable"><a class="menu-item" href="">Shop</a><span class="sub-menu--expander"><i class="icon_plus"></i></span>
                          <ul class="sub-menu">
                            <li><a href="shop_grid+list_fullwidth.html">Shop grid fullwidth</a></li>
                            <li><a href="shop_grid+list_fullwidth.html">Shop list fullwidth</a></li>
                            <li><a href="shop_grid+list_3col.html">shop grid 3 column</a></li>
                            <li><a href="shop_grid+list_3col.html">shop list 3 column</a></li>
                            <li><a href="shop_detail.html">shop detail</a></li>
                            <li><a href="shop_detail_fullwidth.html">shop detail fullwidth</a></li>
                            <li><a href="shop_checkout.html">checkout</a></li>
                            <li><a href="shop_order_complete.html">order complete</a></li>
                            <li><a href="shop_wishlist.html">wishlist</a></li>
                            <li><a href="shop_compare.html">compare</a></li>
                            <li><a href="shop_cart.html">cart</a></li>
                          </ul>
                        </li>
                        <li class="toggleable"> <a class="menu-item" href="blog_list_sidebar.html">Blog</a><span class="sub-menu--expander"><i class="icon_plus"></i></span>
                          <ul class="sub-menu">
                            <li><a href="blog_list_sidebar.html">Blog List Sidebar</a></li>
                            <li><a href="blog_grid_2col.html">Blog Grid 2 column</a></li>
                            <li><a href="blog_grid_sidebar.html">Blog Grid sidebar</a></li>
                            <li><a href="blog_masonry.html">Blog masonry</a></li>
                            <li><a href="blog_grid_1col.html">Blog Grid 1 column sidebar</a></li>
                            <li><a href="blog_detail_sidebar.html">Blog detail sidebar</a></li>
                          </ul>
                        </li>
                        <li class="toggleable"><a class="menu-item" href="#">Pages</a><span class="sub-menu--expander"><i class="icon_plus"></i></span>
                          <ul class="sub-menu">
                            <li><a href="login.html">login</a></li>
                            <li><a href="register.html">register</a></li>
                            <li><a href="faq.html">FAQ</a></li>
                            <li><a href="coming_soon.html">coming soon</a></li>
                            <li><a href="about_us.html">about us</a></li>
                            <li><a href="contact_us.html">contact us</a></li>
                            <li><a href="404_error.html">404 error</a></li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                    <div class="mobile-login">
                      <h2>My account</h2><a href="login.html">Login</a><a href="register.html">Register</a>
                    </div>
                    <div class="mobile-social"><a href=""><i class="fab fa-facebook-f"> </i></a><a href=""><i class="fab fa-twitter"></i></a><a href=""><i class="fab fa-invision"> </i></a><a href=""><i class="fab fa-pinterest-p"> </i></a></div>
                  </div>
                  <div class="ogamin-mobile-menu_bg"></div>
                </div>
              </div>
              <div class="col-6">
                <div class="mobile-menu_logo text-center d-flex justify-content-center align-items-center"><a href=""><img src="{{asset('public/frontend/assets/images/logo.png')}}" alt=""></a></div>
              </div>
              <div class="col-3">
                <div class="mobile-product_function d-flex align-items-center justify-content-end"><a class="function-icon icon_heart_alt" href="wishlist.html"></a><a class="function-icon icon_bag_alt" href=""></a></div>
              </div>
            </div>
          </div>
        </div>
        <nav class="navigation navigation_v2 d-flex align-items-center">
          <div class="ogami-container-fluid">
            <div class="row align-items-xxl-center">
              <div class="col-12 col-xl-6 col-xxxl-1 text-lg-center text-xl-left order-xl-1 order-xxxl-1"><a class="logo" href="{{URL::to('/home')}}"><img src="{{asset('public/frontend/assets/images/logo.png')}}" alt=""></a></div>
              <div class="col-12 col-md-12 col-xl-6 col-xxxl-4 order-xl-3 order-xxxl-2">
                <div class="navigation-filter">
                  <div class="website-search_v2">
                    <form action="{{URL::to('/search')}}" method="POST">
                      <div class="row no-gutters">
                        <div class="col-0 col-md-3 col-lg-3 col-xl-4">
                          <div class="filter-search">
                            <div class="categories-select d-flex align-items-center justify-content-around"><span>Danh Mục Sản Phẩm</span><i class="arrow_carrot-down"></i></div>
                            <div class="categories-select_box">
                              <ul >
                                @foreach($category as $key => $val_cate)
                                <li>
                                  <a href="{{URL::to('/category_home/'.$val_cate->MaDM)}}" style="text-decoration: none; color: black;">{{$val_cate->TenDanhMuc}}</a>
                                </li>
                                @endforeach
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="col-8 col-md-7 col-lg-8 col-xl-7">
                          <div class="search-input">
                            {{ csrf_field() }}
                            <input class="no-round-input no-border" type="text" placeholder="Tìm Kiếm" name="key">
                          </div>
                        </div>
                        <div class="col-4 col-md-2 col-lg-1 col-xl-1">
                          <button type="submit" class="no-round-btn"><i class="icon_search"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-8 col-xl-6 col-xxxl-5 order-xl-4 order-xxxl-3">
                <div class="navgition-menu d-flex align-items-center justify-content-center justify-content-xl-center">
                  <ul class="mb-0">
                    <li class="toggleable"> <a class="menu-item active" href="">Trang Chủ</a>
                    </li>
                    <li class="toggleable"> <a class="menu-item" href="">Sản Phẩm</a>
                      <ul class="sub-menu shop d-flex">
                        <div class="nav-column">
                          <h2>Danh Mục</h2>
                          @foreach($category as $key => $val_cate)
                          <li><a href="{{URL::to('/category_home/'.$val_cate->MaDM)}}">{{$val_cate->TenDanhMuc}}</a></li>
                          @endforeach
                        </div>
                        <div class="nav-column">
                          <h2>Loại Hàng</h2>
                          @foreach($list as $key => $val)
                          <li><a href="{{URL::to('/show_catechild/'.$val->MaLoai)}}">{{$val->TenLoai}}</a></li>
                          @endforeach
                        </div>
                      </ul>
                    </li>
                    <li class="toggleable"><a class="menu-item" href="{{URL::to('/contact_us')}}">Liên Hệ</a></li>
                    <li class="toggleable"> <a class="menu-item" href="#">Giới Thiệu</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-4 col-xl-6 col-xxxl-2 order-xl-2 order-xxxl-4">
                <div class="product-function d-flex align-items-center justify-content-center justify-content-xl-end">
                  <div id="wishlist"><a class="function-icon icon_heart_alt" href="{{URL::to('/wish_list')}}"></a></div>
                  <div id="cart"><a class="function-icon icon_bag_alt" href="{{URL::to('/cart_shopping')}}">
                    <span id="total">0</span>
                  </a></div>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </header>
      <!-- End header-->
      
      @yield('contend')
      
      <div class="partner partner_block-bgless">
        <div class="ogami-container-fluid">
          <div class="partner_block d-flex justify-content-between" data-slick="{&quot;slidesToShow&quot;: 8}">
            <div class="partner--logo" href=""> <a href="#"><img src="{{asset('public/frontend/assets/images/logo/3-mien.jpg')}}" alt="partner logo"></a></div>
            <div class="partner--logo" href=""> <a href="#"><img src="{{asset('public/frontend/assets/images/logo/cp.jpg')}}" alt="partner logo"></a></div>
            <div class="partner--logo" href=""> <a href="#"><img src="{{asset('public/frontend/assets/images/logo/haohao.jpg')}}" alt="partner logo"></a></div>
            <div class="partner--logo" href=""> <a href="#"><img src="{{asset('public/frontend/assets/images/logo/meat-master.jpeg')}}" alt="partner logo"></a></div>
            <div class="partner--logo" href=""> <a href="#"><img src="{{asset('public/frontend/assets/images/logo/vissan.jpg')}}" alt="partner logo"></a></div>
            <div class="partner--logo" href=""> <a href="#"><img src="{{asset('public/frontend/assets/images/logo/neptune.jpg')}}" alt="partner logo"></a></div>
            <div class="partner--logo" href=""> <a href=""><img src="{{asset('public/frontend/assets/images/logo/ofood.png')}}" alt="partner logo"></a></div>
            <div class="partner--logo" href=""> <a href="#"><img src="{{asset('public/frontend/assets/images/logo/yopokki.jpg')}}" alt="partner logo"></a></div>
            <div class="partner--logo" href=""> <a href="#"><img src="{{asset('public/frontend/assets/images/logo/oishi.jpg')}}" alt="partner logo"></a></div>
            <div class="partner--logo" href=""> <a href="#"><img src="{{asset('public/frontend/assets/images/logo/peke.jpg')}}" alt="partner logo"></a></div>
            <div class="partner--logo" href=""> <a href="#"><img src="{{asset('public/frontend/assets/images/logo/tuong-an.jpg')}}" alt="partner logo"></a></div>
            <div class="partner--logo" href=""> <a href="#"><img src="{{asset('public/frontend/assets/images/logo/kinh-do.jpg')}}" alt="partner logo"></a></div>
          </div>
        </div>
      </div>
      <!-- End partner-->
      <footer>
        <div class="ogami-container-fluid">
          <div class="footer-v2_header">
            <div class="row">
              <div class="col-12 col-lg-4 col-xl-3 text-sm-center text-lg-left">
                <div class="footer-logo"><img src="{{asset('public/frontend/assets/images/logo.png')}}" alt=""></div>
                <div class="footer-contact">
                  {{-- <p>Địa Chỉ: {{$contact->DiaChi}}</p>
                  <p>Số Điện Thoại: {{$contact->SoDienThoai}}</p>
                  <p>Email: {{$contact->Email}}</p> --}}
                </div>
                <div class="footer-social"><a class="round-icon-btn" href=""><i class="fab fa-facebook-f"> </i></a><a class="round-icon-btn" href=""><i class="fab fa-twitter"></i></a><a class="round-icon-btn" href=""><i class="fab fa-invision"> </i></a><a class="round-icon-btn" href=""><i class="fab fa-pinterest-p"></i></a></div>
              </div>
              <div class="col-lg-8 col-xl-9">
                <div class="row no-gutters justify-content-md-center justify-content-lg-between">
                  <div class="col-12 col-sm-4 col-lg-4 col-xl-2 col-xxl-3 text-sm-center text-lg-left">
                    <div class="footer-quicklink">
                      <h5>Infomation</h5><a href="about_us.html">About us</a><a href="checkout.html">Check out</a><a href="contact.html">Contact</a><a href="about_us.html">Service</a>
                    </div>
                  </div>
                  <div class="col-12 col-sm-4 col-lg-4 col-xl-2 col-xxl-3 text-sm-center text-lg-left">
                    <div class="footer-quicklink">
                      <h5>My Account</h5><a href="login.html">My Account</a><a href="contact.html">Contact</a><a href="shop_cart.html">Shopping cart</a><a href="shop_grid+list_3col.html">Shop</a>
                    </div>
                  </div>
                  <div class="col-12 col-sm-4 col-lg-4 col-xl-2 col-xxl-3 text-sm-center text-lg-left">
                    <div class="footer-quicklink">
                      <h5>Quick Shop</h5><a href="about_us.html">About us</a><a href="checkout.html">Check out</a><a href="contact.html">Contact</a><a href="about_us.html">Service</a>
                    </div>
                  </div>
                  <div class="col-12 col-md-8 col-lg-8 col-xl-6 col-xxl-3 text-sm-center text-lg-left">
                    <div class="newletter newletter_v2">
                      <div class="newletter_text">
                        <h5>Đăng ký nhận tin khuyến mãi</h5>
                      </div>
                      <div class="newletter_input">
                        <input class="round-input" type="email" placeholder="Email">
                        <button>Subcribe</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="footer-credit">
          <div class="ogami-container-fluid">
            <div class="footer-creadit_block d-flex flex-column flex-md-row justify-content-start justify-content-md-between align-items-baseline align-items-md-center">
              <p class="author">Copyright © 2019 Ogami - All Rights Reserved.</p><img class="payment-method" src="{{asset('public/frontend/assets/images/payment.png')}}" alt="">
            </div>
          </div>
        </div>
      </footer>
      <!-- End footer-->
    </div>
    
    <script src="{{asset('public/frontend/assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/slick.min.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/jquery.easing.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/jquery.zoom.min.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/parallax.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/jquery.fancybox.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/numscroller-1.0.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/vanilla-tilt.min.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/main.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/process.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/sweetalert.min.js')}}"></script>
    <script>
      var sence = document.getElementById('img-block')
      var parallaxInstance = new Parallax(sence, {
        hoverOnly: true,
      });
    </script>
    <script type="text/javascript">
      $(document).on('click', '.quickview', function(event) {
      event.preventDefault();
      //Wirte Quick view block to DOM
      $('body').prepend('<div id="quickview"> <div class="quickview-box"> <button class="round-icon-btn" id="quickview-close-btn"><i class="fas fa-times"></i></button> <div class="row"> <div class="col-12 col-md-6" id="product-image"> </div><div class="col-12 col-md-6"> <div class="shop-detail_info"> <h5 class="product-type color-type" id="product-type">Oranges</h5><div id="product-name" ></div> <div class="price-rate"> <h3 class="product-price" id="product-price"> <del>$35.00</del>$14.00 </h3> </div><p class="product-describe" id="product-desc"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident vero saepe nihil nisi ipsum officiis, tempora reiciendis, rerum ipsa aliquid, repudiandae expedita placeat, vel quae commodi sequi. Repellat, laudantium voluptas.</p><div class="quantity-select"> <label for="quantity">Số Lượng:</label> <input class="no-round-input" id="quantity" type="number" min="0" value="1"> <label id="product-qty"></label> </div><div class="product-select"> <button class="add-to-cart normal-btn outline">Add to Cart</button> <button class="add-to-compare normal-btn outline">+ Add to Compare</button> </div><div class="product-share"> <h5>Share link:</h5><a href=""><i class="fab fa-facebook-f"> </i></a><a href=""><i class="fab fa-twitter"></i></a><a href=""><i class="fab fa-invision"> </i></a><a href=""><i class="fab fa-pinterest-p"></i></a> </div></div></div></div></div></div>')
      $('#quickview .big-img_qv').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        asNavFor: '.slide-img_qv',
        swipe: false,
        infinite: false,
      });
      $('#quickview .slide-img_qv').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.big-img',
        focusOnSelect: true,
        appendArrows: $('.slide-img_qv'),
        adaptiveHeight: false,
        infinite: false,
        prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
      });
      $('#quickview-close-btn').on('click', function(event) {
        $('#quickview').remove()
      });
    });


    $(document).on('click', '.add_address', function(event) {
        event.preventDefault();
      //Wirte Quick view block to DOM
    $('body').prepend('<div id="quickview"> <div class="quickview-box"> <button class="round-icon-btn" id="quickview-close-btn"><i class="fas fa-times"></i></button> <div class="row"> <div class="col-12 col-md-12" id="product-image"> <div class="account"><div class="container"><div class="row"><div class="col-12 col-md-10 mx-auto"><h1 class="title">THÊM ĐỊA CHỈ</h1><form action="{{URL::to('/add_address')}}" method="post">{{csrf_field() }}<label for="HoTenKH">Họ Tên</label><input class="no-round-input" id="HoTen" type="text" name="HoTen" value=""><label for="HoTenKH">Số Điện Thoại</label><input class="no-round-input" id="SDT" type="text" name="SDT" value=""><label for="HoTenKH">Địa Chỉ</label><input class="no-round-input" id="DiaChi" type="text" name="DiaChi" value=""><div class="account-function"><button class="no-round-btn" type="submit" name="Them">Thêm</button></div></form></div></div></div></div> </div> </div> </div> </div>')
      $('#quickview-close-btn').on('click', function(event) {
        $('#quickview').remove()
      });
    });

    $(document).on('click', '.update_address', function(event) {
        event.preventDefault();
      //Wirte Quick view block to DOM
    $('body').prepend('<div id="quickview"> <div class="quickview-box"> <button class="round-icon-btn" id="quickview-close-btn"><i class="fas fa-times"></i></button> <div class="row"> <div class="col-12 col-md-12" id="product-image"> <div class="account"><div class="container"><div class="row"><div class="col-12 col-md-10 mx-auto"><h1 class="title">THÊM ĐỊA CHỈ</h1><form action="{{URL::to('/update_address')}}" method="post">{{csrf_field()}}<label for="HoTenKH">Họ Tên</label><input class="no-round-input" id="HoTen" type="text" name="HoTen" value=""><label for="HoTenKH">Số Điện Thoại</label><input class="no-round-input" id="SDT" type="text" name="SDT" value=""><label for="HoTenKH">Địa Chỉ</label><input class="no-round-input" id="DiaChi" type="text" name="DiaChi" value=""><input class="no-round-input" id="MaDC" type="hidden" name="MaDC" value=""><div class="account-function"><button class="no-round-btn" type="submit" name="Them">Cập Nhật</button></div></form></div></div></div></div> </div> </div> </div> </div>')
      $('#quickview-close-btn').on('click', function(event) {
        $('#quickview').remove()
      });
    });
    </script>

    <script type="text/javascript">

    $(document).ready(function() {

      load_total();
      load_comment();

      function load_total(){
        $.ajax({
          url: '{{url('/update_total')}}',
          method: "GET",
          data:{},
          success:function(data){
            $('#total').html(data);
          }
        });
      }
      //Thêm vào giỏ hàng
      $('.add-to-cart').click(function(){
        var id = $(this).data('id');
        var cart_product_id = $('.cart_product_id_' + id).val();
        var cart_product_name = $('.cart_product_name_' + id).val();
        var cart_product_image = $('.cart_product_image_' + id).val();
        var cart_product_price = $('.cart_product_price_' + id).val();
        var cart_product_qty = $('.cart_product_qty_' + id).val();
        var cart_product_discount = $('.cart_product_discount_' + id).val();
        var _token = $('input[name="_token"]').val();
        
        $.ajax({
          url: '{{url('/add_cart_ajax')}}',
          method: 'POST',
          dataType: 'JSON',
          data:{
            cart_product_id:cart_product_id,
            cart_product_name:cart_product_name,
            cart_product_image:cart_product_image,
            cart_product_price:cart_product_price,
            cart_product_qty:cart_product_qty,
            cart_product_discount:cart_product_discount,
            _token:_token},
            success:function(data){
              if(data.error==0){
                load_total();
                swal({
                  title: "Thêm vào giỏ hàng thành công",
                  icon: "success",
                  button: "OK",
                });
              }else{
                swal({
                  title: "Số lượng tồn không đủ",
                  icon: "warning",
                  button: "OK",
                });
              }
            }
        });
      });

      //Quick view
      $('.quickview').click(function(){
        var id_product = $(this).data('id_product');
        var _token = $('input[name="_token"]').val();

        $.ajax({
          url: '{{url('/quickview')}}',
          method: "POST",
          dataType: "JSON",
          data:{id_product:id_product,_token:_token},
          success:function(data){
            $('#product-name').html(data.TenSP);
            $('#product-image').html(data.Image);
            $('#product-desc').html(data.ThongTin);
            $('#product-type').html(data.DanhMuc)
            $('#product-qty').html(data.SoLuong);
            $('#product-price').html(data.Gia);
            // $('#product-review').html(data.review);
            // $('#product-rating').html(data.rating);
          }
        });
      });

      //Thêm sản phẩm yêu thích
      $('.add-to-wishlist').click(function(){
        var id_product = $(this).data('id_product');
        var _token = $('input[name="_token"]').val();
        $.ajax({
          url: '{{url('/favourite_product')}}',
          method: "POST",
          dataType: "JSON",
          data:{id_product:id_product,_token:_token},
          success:function(data){
            if(data.status==1){
              swal({
                title: "Thêm yêu thích thành công",
                icon: "success",
                button: "OK",
              });
            }else if(data.status==2){
              swal({
                title: "Sản phẩm đã được thêm",
                icon: "warning",
                button: "OK",
              });
            }else{
              swal({
                title: "Bạn chưa đăng nhập",
                icon: "warning",
                button: "OK",
              });
            }
          }
        });
      });

      //Xoá khỏi sp yêu thích
      $('.del_wishlist').click(function(){
        var id = $(this).data('id_product');
        var _token = $('input[name="_token"]').val();
        $.ajax({
          url: '{{url('/delete_wishlist')}}',
          method: "POST",
          data:{Ma:id,_token:_token},
          success:function(data){
            location.reload();
          }
        });
      });

      //Lọc sản phẩm
      $('#sort_by').on('change', function(){  
        var url = $(this).val();
        if(url){
          window.location= url;
        }
        return false;
      });

      //Lọc Giá
      $('#sort-price').click(function(){
        var value = $('#amount').val();
        var i = value.lastIndexOf('-');
        var min = value.slice(0, i);
        var max = value.slice(i+1);

        var url = "{{Request::url()}}?sort_by=price&MIN="+ min +"&MAX="+ max;
        if(url){
          window.location= url;
        }
        return false;
      });


      function load_comment(){
        var id_product = $('.cmt_pro_id').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
          url: '{{url('/load_comment')}}',
          method: "POST",
          data:{id_product:id_product,_token:_token},
          success:function(data){
            $('#review').html(data);
          }
        });
      }

      //Thêm đánh giá
      $('.cmt_add').click(function(){
        var id_product = $('.cmt_pro_id').val();
        var content = $('.cmt_content').val();
        var _token = $('input[name="_token"]').val();
        var rating = $('input[name="star"]:checked').val();
        $.ajax({
          url: '{{url('/add_comment')}}',
          method: "POST",
          data:{
            id_product:id_product,
            _token:_token,
            content:content,
            rating: rating},
            success:function(data){
              load_comment();
            },error: function() {
             swal({
              title: "Bạn Chưa Đăng Nhập",
              icon: "warning",
              button: "OK",
            });
           }
         });
      });

      //Load địa chỉ giao hàng
      $('.update_address').click(function(){
        var MaDC = $(this).data('id');
        var _token = $('input[name="_token"]').val();

        $.ajax({
          url: '{{url('/address_detail')}}',
          method: "POST",
          dataType: "JSON",
          data:{
            MaDC:MaDC,
            _token:_token
          },
          success:function(data){
            $('#HoTen').val(data.HoTen);
            $('#SDT').val(data.SDT);
            $('#DiaChi').val(data.DiaChi);
            $('#MaDC').val(data.MaDC);
          }
        });
      });




  });
    </script>
  </body>
</html>