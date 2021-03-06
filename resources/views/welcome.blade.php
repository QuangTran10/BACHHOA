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
                            <li><a href="{{URL::to('/my_account')}}"><i class="fas fa-user"></i>T??i Kho???n C???a T??i</a></li>
                            <li><a href="{{URL::to('/show_order')}}"><i class="fas fa-shopping-bag"></i> Qu???n L?? ????n H??ng</a></li>
                          </ul>
                        </div>
                      </div>
                      <?php  
                      }else{
                      ?>  
                        <a href="{{URL::to('/login_home')}}"><i class="fas fa-user"></i> ????ng Nh???p</a>
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
                    <button class="no-round-btn" id="mobile-menu--closebtn"><i class="fas fa-times"></i></button>
                    <div class="mobile-menu_items">
                      <ul class="mb-0 d-flex flex-column">
                        <li class="toggleable"> <a class="menu-item active" href="{{URL::to('/home')}}">Trang Ch???</a></li>
                        <li class="toggleable"> <a class="menu-item" href=>Danh M???c</a><span class="sub-menu--expander"><i class="icon_plus"></i></span>
                          <ul class="sub-menu">
                            @foreach($category as $key => $val_cate)
                            <li>
                              <a href="{{URL::to('/category_home/'.$val_cate->MaDM)}}" style="text-decoration: none; color: black;">{{$val_cate->TenDanhMuc}}</a>
                            </li>
                            @endforeach
                          </ul>
                        </li>
                      </ul>
                    </div>
                    <div class="mobile-login">
                      <h2>T??i Kho???n C???a T??i</h2>
                      <?php
                        if($name_user){
                      ?>
                        <a href="{{URL::to('/my_account')}}">T??i Kho???n</a><a href="{{URL::to('/show_order')}}">Qu???n L?? ????n H??ng</a>
                      <?php
                        }else{
                      ?>  
                        <a href="{{URL::to('/login_home')}}">????ng Nh???p</a><a href="{{URL::to('/register_home')}}">????ng K??</a>
                      <?php
                        }
                      ?>
                    </div>
                  </div>
                  <div class="ogamin-mobile-menu_bg"></div>
                </div>
              </div>
              <div class="col-6">
                <div class="mobile-menu_logo text-center d-flex justify-content-center align-items-center"><a href=""><img src="{{asset('public/frontend/assets/images/logo_white.png')}}" alt=""></a></div>
              </div>
              <div class="col-3">
                <div class="mobile-product_function d-flex align-items-center justify-content-end"><a class="function-icon icon_heart_alt" href="{{URL::to('/wish_list')}}"></a><a class="function-icon icon_bag_alt" href="{{URL::to('/cart_shopping')}}"></a></div>
              </div>
            </div>
          </div>
        </div>
        <nav class="navigation navigation_v2 d-flex align-items-center">
          <div class="ogami-container-fluid">
            <div class="row align-items-xxl-center">
              <div class="col-12 col-xl-6 col-xxxl-1 text-lg-center text-xl-left order-xl-1 order-xxxl-1"><a class="logo" href="{{URL::to('/home')}}"><img src="{{asset('public/frontend/assets/images/logo_white.png')}}" alt=""></a></div>
              <div class="col-12 col-md-12 col-xl-6 col-xxxl-4 order-xl-3 order-xxxl-2">
                <div class="navigation-filter">
                  <div class="website-search_v2">
                    <div class="row no-gutters">
                      <div class="col-0 col-md-3 col-lg-3 col-xl-4">
                        <div class="filter-search">
                          <div class="categories-select d-flex align-items-center justify-content-around"><span>Danh M???c S???n Ph???m</span><i class="arrow_carrot-down"></i></div>
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
                          <input class="no-round-input no-border search-txt" type="text" placeholder="T??m Ki???m" name="key">
                        </div>
                      </div>
                      <div class="col-4 col-md-2 col-lg-1 col-xl-1">
                        <button class="no-round-btn search-btn"><i class="icon_search"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-8 col-xl-6 col-xxxl-5 order-xl-4 order-xxxl-3">
                <div class="navgition-menu d-flex align-items-center justify-content-center justify-content-xl-center">
                  <ul class="mb-0">
                    <li class="toggleable"> <a class="menu-item active" href="">Trang Ch???</a>
                    </li>
                    <li class="toggleable"> <a class="menu-item" href="">S???n Ph???m</a>
                      <ul class="sub-menu shop d-flex">
                        <div class="nav-column">
                          <h2>Danh M???c</h2>
                          @foreach($category as $key => $val_cate)
                          <li><a href="{{URL::to('/category_home/'.$val_cate->MaDM)}}">{{$val_cate->TenDanhMuc}}</a></li>
                          @endforeach
                        </div>
                        <div class="nav-column">
                          <h2>Lo???i H??ng</h2>
                          @foreach($list as $key => $val)
                          <li><a href="{{URL::to('/show_catechild/'.$val->MaLoai)}}">{{$val->TenLoai}}</a></li>
                          @endforeach
                        </div>
                      </ul>
                    </li>
                    <li class="toggleable"><a class="menu-item" href="{{URL::to('/contact_us')}}">Li??n H???</a></li>
                    <li class="toggleable"> <a class="menu-item" href="{{URL::to('/about_us')}}">Gi???i Thi???u</a></li>
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
              <div class="col-12 col-lg-5 col-xl-6 text-sm-center text-lg-left">
                <div class="footer-logo"><img src="{{asset('public/frontend/assets/images/logo.png')}}" alt=""></div>
                <div class="footer-contact">
                  <p><b>?????a Ch???:</b> 27 Hai B?? Tr??ng, Ph?????ng 3, Th??nh ph??? S??c Tr??ng</p>
                  <p><b>S??? ??i???n Tho???i:</b> 0859083181</p>
                  <p><b>Email:</b> qtran8219@gmail.com</p>
                </div>
                <div class="footer-social"><a class="round-icon-btn" href=""><i class="fab fa-facebook-f"> </i></a><a class="round-icon-btn" href=""><i class="fab fa-twitter"></i></a><a class="round-icon-btn" href=""><i class="fab fa-invision"> </i></a><a class="round-icon-btn" href=""><i class="fab fa-pinterest-p"></i></a></div>
              </div>
              <div class="col-lg-7 col-xl-6">
                <div class="row no-gutters justify-content-md-center justify-content-lg-between">
                  <div class="col-12 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 text-sm-center text-lg-left">
                    <div class="footer-quicklink">
                      <h5>Th??ng Tin</h5><a href="">Ch??nh S??ch ?????i Tr???</a><a href="">Ch??nh S??ch Giao H??ng</a><a href="{{URL::to('/contact_us')}}">Li??n H???</a><a href="">Gi???i Thi???u</a>
                    </div>
                  </div>
                  <div class="col-12 col-md-8 col-lg-8 col-xl-8 col-xxl-8 text-sm-center text-lg-left">
                    <div class="newletter newletter_v2">
                      <div class="newletter_text">
                        <h5>????ng k?? nh???n tin khuy???n m??i</h5>
                      </div>
                      <div class="newletter_input">
                        <input class="round-input" type="email" placeholder="Email">
                        <button>????ng K??</button>
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
              <p class="author"></p><img class="payment-method" src="{{asset('public/frontend/assets/images/payment.png')}}" alt="">
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
      $('body').prepend('<div id="quickview"> <div class="quickview-box"> <button class="round-icon-btn" id="quickview-close-btn"><i class="fas fa-times"></i></button> <div class="row"> <div class="col-12 col-md-6" id="product-image"> </div><div class="col-12 col-md-6"> <div class="shop-detail_info"> <h5 class="product-type color-type" id="product-type">Oranges</h5><div id="product-name" ></div> <div class="price-rate"> <h3 class="product-price" id="product-price"> <del>$35.00</del>$14.00 </h3> </div><p class="product-describe" id="product-desc"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident vero saepe nihil nisi ipsum officiis, tempora reiciendis, rerum ipsa aliquid, repudiandae expedita placeat, vel quae commodi sequi. Repellat, laudantium voluptas.</p><div class="quantity-select"> <label for="quantity">S??? L?????ng:</label> <input class="no-round-input" id="quantity" type="number" min="0" value="1"> <label id="product-qty"></label> </div> <div class="product-share"> <h5>Share link:</h5><a href=""><i class="fab fa-facebook-f"> </i></a><a href=""><i class="fab fa-twitter"></i></a><a href=""><i class="fab fa-invision"> </i></a><a href=""><i class="fab fa-pinterest-p"></i></a> </div></div></div></div></div></div>')
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
    $('body').prepend('<div id="quickview"> <div class="quickview-box"> <button class="round-icon-btn" id="quickview-close-btn"><i class="fas fa-times"></i></button> <div class="row"> <div class="col-12 col-md-12" id="product-image"> <div class="account"><div class="container"><div class="row"><div class="col-12 col-md-10 mx-auto"><h1 class="title">TH??M ?????A CH???</h1><form action="{{URL::to('/add_address')}}" method="post">{{csrf_field() }}<label for="HoTenKH">H??? T??n</label><input class="no-round-input" id="HoTen" type="text" name="HoTen" value=""><label for="HoTenKH">S??? ??i???n Tho???i</label><input class="no-round-input" id="SDT" type="text" name="SDT" value=""><label for="HoTenKH">?????a Ch???</label><input class="no-round-input" id="DiaChi" type="text" name="DiaChi" value=""><div class="account-function"><button class="no-round-btn" type="submit" name="Them">Th??m</button></div></form></div></div></div></div> </div> </div> </div> </div>')
      $('#quickview-close-btn').on('click', function(event) {
        $('#quickview').remove()
      });
    });

    $(document).on('click', '.update_address', function(event) {
        event.preventDefault();
      //Wirte Quick view block to DOM
    $('body').prepend('<div id="quickview"> <div class="quickview-box"> <button class="round-icon-btn" id="quickview-close-btn"><i class="fas fa-times"></i></button> <div class="row"> <div class="col-12 col-md-12" id="product-image"> <div class="account"><div class="container"><div class="row"><div class="col-12 col-md-10 mx-auto"><h1 class="title">C???P NH???T ?????A CH???</h1><form action="{{URL::to('/update_address')}}" method="post">{{csrf_field()}}<label for="HoTenKH">H??? T??n</label><input class="no-round-input" id="HoTen" type="text" name="HoTen" value=""><label for="HoTenKH">S??? ??i???n Tho???i</label><input class="no-round-input" id="SDT" type="text" name="SDT" value=""><label for="HoTenKH">?????a Ch???</label><input class="no-round-input" id="DiaChi" type="text" name="DiaChi" value=""><input class="no-round-input" id="MaDC" type="hidden" name="MaDC" value=""><div class="account-function"><button class="no-round-btn" type="submit" name="Them">C???p Nh???t</button></div></form></div></div></div></div> </div> </div> </div> </div>')
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
      //Th??m v??o gi??? h??ng
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
                  title: "Th??m v??o gi??? h??ng th??nh c??ng",
                  icon: "success",
                  button: "OK",
                });
              }else{
                swal({
                  title: "S??? l?????ng t???n kh??ng ?????",
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
          }
        });
      });

      //Th??m s???n ph???m y??u th??ch
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
                title: "Th??m y??u th??ch th??nh c??ng",
                icon: "success",
                button: "OK",
              });
            }else if(data.status==2){
              swal({
                title: "S???n ph???m ???? ???????c th??m",
                icon: "warning",
                button: "OK",
              });
            }else{
              swal({
                title: "B???n ch??a ????ng nh???p",
                icon: "warning",
                button: "OK",
              });
            }
          }
        });
      });

      //Xo?? kh???i sp y??u th??ch
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

      //L???c s???n ph???m
      $('#sort_by').on('change', function(){  
        var url = $(this).val();
        if(url){
          window.location= url;
        }
        return false;
      });

      //L???c Gi??
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

      //T??m ki???m
      $('.search-btn').click(function(event) {
        var key = $('.search-txt').val();
        var url = '{{url('/search')}}?key='+key;
        if(url){
          window.location= url;
        }else{
          swal({
            title: "Kh??ng T??m Th???y",
            icon: "warning",
            button: "OK",
          });
        }
      });

      //Load c??c comment
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

      //Th??m ????nh gi??
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
              title: "B???n Ch??a ????ng Nh???p",
              icon: "warning",
              button: "OK",
            });
           }
         });
      });

      //Load ?????a ch??? giao h??ng
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