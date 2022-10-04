<!DOCTYPE html>
<html lang="en">
  <head>
    <title>BEE STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <meta name="author" content="Louis Tran">
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link  rel="canonical" href="{{$url}}" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> --}}
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
    <link rel="shortcut icon" href="{{asset('public/frontend/assets/images/bee-logo.png')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
  </head>
  <body>
    <div id="main">
      <header> 
        <div class="header-block d-flex align-items-center">
          <div class="container">
            <div class="row">
              <div class="col-12 col-md-6">
                <div class="header-left d-flex flex-column flex-md-row align-items-center">
                  <p class="d-flex align-items-center"><i class="fas fa-envelope"></i>qtran8219@gmail.com</p>
                  <p class="d-flex align-items-center"><i class="fas fa-phone"></i>+84 859083181</p>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="header-right d-flex flex-column flex-md-row justify-content-md-end justify-content-center align-items-center">
                  <div class="language">
                    <div class="selected-language"><img src="{{asset('public/frontend/assets/images/homepage01/vietnam.png')}}" alt="">Viet Nam<i class="arrow_carrot-down"></i>
                      <ul class="list-language">
                        <li><img src="{{asset('public/frontend/assets/images/homepage01/usa.png')}}" alt="">English</li>
                      </ul>
                    </div>
                  </div>
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
        <nav class="navigation d-flex align-items-center">
          <div class="container">
            <div class="row">
              <div class="col-2"><a class="logo" href="{{URL::to('/home')}}"><img src="{{asset('public/frontend/assets/images/bee.png')}}" alt=""></a></div>
              <div class="col-8">
                <div class="navgition-menu d-flex align-items-center justify-content-center">
                  <ul class="mb-0">
                    <li class="toggleable"> <a class="menu-item" href="{{URL::to('/home')}}">Trang Chủ</a>
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
                    <li class="toggleable"><a class="menu-item" href="{{URL::to('/about_us')}}">Giới Thiệu</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-2">
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
         <div id="mobile-menu">
          <div class="container">
            <div class="row">
              <div class="col-3">
                <div class="mobile-menu_block d-flex align-items-center"><a class="mobile-menu--control" href="#"><i class="fas fa-bars"></i></a>
                  <div id="ogami-mobile-menu">
                    <button class="no-round-btn" id="mobile-menu--closebtn"><i class="fas fa-times"></i></button>
                    <div class="mobile-menu_items">
                      <ul class="mb-0 d-flex flex-column">
                        <li class="toggleable"> <a class="menu-item active" href="{{URL::to('/home')}}">Trang Chủ</a></li>
                        <li class="toggleable"> <a class="menu-item" href=>Danh Mục</a><span class="sub-menu--expander"><i class="icon_plus"></i></span>
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
                      <h2>Tài Khoản Của Tôi</h2>
                      <?php
                        if($name_user){
                      ?>
                        <a href="{{URL::to('/my_account')}}">Tài Khoản</a><a href="{{URL::to('/show_order')}}">Quản Lý Đơn Hàng</a>
                      <?php
                        }else{
                      ?>  
                        <a href="{{URL::to('/login_home')}}">Đăng Nhập</a><a href="{{URL::to('/register_home')}}">Đăng Ký</a>
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
        <div class="navigation-filter"> 
          <div class="container">
            <div class="row">
              <div class="col-12 col-md-4 col-lg-4 col-xl-3 order-2 order-md-1">
                <div class="department-menu_block">
                  <div class="department-menu d-flex justify-content-between align-items-center"><i class="fas fa-bars"></i>Danh Mục Sản Phẩm<span><i class="arrow_carrot-down"></i></span></div>
                  <div class="department-dropdown-menu">
                    <ul>
                      @foreach($category as $key => $val_cate)
                      <li>
                        <a href="{{URL::to('/category_home/'.$val_cate->MaDM)}}">{{$val_cate->TenDanhMuc}}</a>
                      </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-8 col-lg-8 col-xl-9 order-1 order-md-2">
                <div class="website-search">
                  <div class="row no-gutters">
                    <div class="col-0 col-md-3 col-lg-3 col-xl-4">
                      <div class="filter-search">
                        <div class="categories-select d-flex align-items-center justify-content-around"><span>Tất cả loại hàng</span><i class="arrow_carrot-down"></i></div>
                        <div class="categories-select_box">
                          <ul>
                            @foreach($list as $key => $val)
                            <li><a href="{{URL::to('/show_catechild/'.$val->MaLoai)}}">{{$val->TenLoai}}</a></li>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="col-8 col-md-7 col-lg-8 col-xl-7">
                      <div class="search-input">
                        <input class="no-round-input no-border search-txt" type="text" placeholder="Tìm Kiếm" name="key" id="search-txt">
                      </div>
                    </div>
                    <div class="col-4 col-md-2 col-lg-1 col-xl-1">
                      <button class="no-round-btn search-btn"><i class="icon_search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- End header-->
      
      @yield('contend')

     
      <!-- End partner-->
      <footer>
        <div class="container">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-4 text-sm-center text-md-left">
              <div class="footer-logo"><img src="{{asset('public/frontend/assets/images/logo.png')}}" alt=""></div>
              <div class="footer-contact">
                <p><b>Địa Chỉ:</b> 27 Hai Bà Trưng, Phường 3, Thành phố Sóc Trăng</p>
                <p><b>Số Điện Thoại:</b> 0859083181</p>
                <p><b>Email:</b> qtran8219@gmail.com</p>
              </div>
              <div class="footer-social"><a class="round-icon-btn" href=""><i class="fab fa-facebook-f"> </i></a><a class="round-icon-btn" href=""><i class="fab fa-twitter"></i></a><a class="round-icon-btn" href=""><i class="fab fa-invision"> </i></a><a class="round-icon-btn" href=""><i class="fab fa-pinterest-p"></i></a></div>
            </div>
            <div class="col-md-8">
              <div class="row">
                <div class="col-12 col-sm-4 text-sm-center text-md-left">
                  <div class="footer-quicklink">
                    <h5>Thông Tin</h5><a href="">Chính Sách Đổi Trả</a><a href="">Chính Sách Giao Hàng</a><a href="{{URL::to('/contact_us')}}">Liên Hệ</a><a href="">Giới Thiệu</a>
                  </div>
                </div>
                <div class="col-12 col-sm-4 text-sm-center text-md-left">
                  <div class="footer-quicklink">
                    <h5>My Account</h5><a href="login.html">My Account</a><a href="contact.html">Contact</a><a href="shop_cart.html">Shopping cart</a><a href="shop_grid+list_3col.html">Shop</a>
                  </div>
                </div>
                <div class="col-12 col-sm-4 text-sm-center text-md-left">
                  <div class="footer-quicklink">
                    <h5>Quick Shop</h5><a href="about_us.html">About us</a><a href="checkout.html">Check out</a><a href="contact.html">Contact</a><a href="about_us.html">Service</a>
                  </div>
                </div>
              </div>
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
      var sence = document.getElementById('img-block')
      var parallaxInstance = new Parallax(sence, {
        hoverOnly: true,
      });
    </script>

    <script type="text/javascript">

    $(document).ready(function() {

      load_total();
      

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

      function getSelectDistrict(){
        var matp = $('#update_province option:selected').val();
        var _token = $('input[name="_token"]').val();
        var option = 'district';
        var id_need_select = $('#id_district').val();

        $.ajax({
          url: '{{url('/get_delivery')}}',
          method: "POST",
          data:{
            option: option,
            _token: _token,
            ma_id: matp,
            is_district: id_need_select
          },
          success:function(data){
            $('#update_district').html(data);
            getSelectHamlet();
          }
        });
        
      }
      function getSelectHamlet(){
        var maqh = $('#update_district option:selected').val();
        var _token = $('input[name="_token"]').val();
        var option = 'hamlet';
        var id_need_select = $('#id_hamlet').val();
        
        $.ajax({
          url: '{{url('/get_delivery')}}',
          method: "POST",
          data:{
            option: option,
            _token: _token,
            ma_id: maqh,
            is_hamlet: id_need_select
          },
          success:function(data){
            $('#update_hamlet').html(data);
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

      //Tìm kiếm
      $('.search-btn').click(function(event) {
        var key = $('.search-txt').val();
        var url = '{{url('/search')}}?key='+key;
        if(url){
          window.location= url;
        }else{
          swal({
            title: "Không Tìm Thấy",
            icon: "warning",
            button: "OK",
          });
        }
      });

      

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
            $('#HoTenKH').val(data.HoTen);
            $('#SDTKH').val(data.SDT);
            $('#DiaChiKH').val(data.DiaChi);
            $('#MaDC').val(data.MaDC);

            $(".update_pro option[value='"+data.matp+"']").attr("selected", true);
            $('#id_district').val(data.maqh);
            $('#id_hamlet').val(data.xaid);
            getSelectDistrict();
          }
        });
      });


      // Select add address
      $('.choose').change(function(event) {
        var action = $(this).attr('id');
        var maid = $(this).val();
        var _token = $('input[name="_token"]').val();
        var result ='';
        if(action == 'province'){
          result ='district';
        }else{
          result = 'hamlet';
        }

        $.ajax({
          url: '{{url('/select_delivery')}}',
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

      //Thêm địa chỉ giao hàng
      $('.submit-address').click(function(event) {
        var HoTen = $('#HoTen').val();
        var SDT = $('#SDT').val();
        var DiaChi = $('#DiaChi').val();
        var province = $('#province').val();
        var district = $('#district').val();
        var hamlet = $('#hamlet').val();
        var _token = $('input[name="_token"]').val();

        $.ajax({
          url: '{{url('/add_address')}}',
          method: 'POST',
          data:{
            HoTen: HoTen,
            SDT: SDT,
            DiaChi: DiaChi,
            province: province,
            district: district,
            hamlet: hamlet,
            _token:_token},
            success:function(data){
              if(data=1){
                location.reload();
              }else{
                swal({
                  title: "Lỗi thêm địa chỉ giao hàng",
                  icon: "error",
                  button: "OK",
                });
              }
            },error: function() {
             swal({
              title: "Lỗi thêm địa chỉ giao hàng",
              icon: "error",
              button: "OK",
            });
           }
        });
      });


  });
    </script>
  </body>
</html>