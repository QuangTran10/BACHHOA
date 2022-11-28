<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta charset="utf-8" />
  {{-- <-Seo meta-> --}}
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('public/backend/assets/img/bee-logo.png')}}">
  <link rel="icon" type="image/png" href="{{asset('public/backend/assets/img/bee-logo.png')}}">
  <title>Admin</title>
  <meta name="description" content="">
  <meta name="keywords" content=""/>
  <meta name="robots" content="INDEX,FOLLOW"/>
  
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link href="{{asset('public/backend/assets/css/material-dashboard.css?v=2.1.2')}}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{asset('public/backend/assets/demo/demo.css')}}" rel="stylesheet" />

  <script src="{{asset('public/backend/assets/js/core/jquery.min.js')}}"></script>
  <style type="text/css">
    .is-danger{
      color: red;
      font-size: 14px;
    }
  </style>
</head>

<body class="">
  <div class="wrapper">
    <div class="sidebar" data-color="purple" data-background-color="black" data-image="{{asset('public/backend/assets/img/sidebar-1.jpg')}}">
      <div class="logo"><a href="" class="simple-text logo-mini">
        </a>
        <a href="" class="simple-text logo-normal">
          BEE STORE
        </a></div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="{{asset('public/backend/images/avatar/avatar_macdinh.jpeg')}}" />
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                <?php
                  $name = Session::get('admin_name');
                  if($name){
                    echo $name;
                  }
                ?>
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="{{URL::to('/user')}}">
                    <span class="sidebar-mini"><i class="material-icons">edit_note</i></span>
                    <span class="sidebar-normal"> Thông Tin Cá Nhân </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{URL::to('/password')}}">
                    <span class="sidebar-mini"><i class="material-icons">password</i></span>
                    <span class="sidebar-normal"> Đổi Mật Khẩu </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item <?php $page = Session::get('page'); if($page==1){echo "active";} ?>">
            <a class="nav-link" href="{{URL::to('/dashboard')}}">
              <i class="material-icons">dashboard</i>
              <p> Tổng Quan </p>
            </a>
          </li>
          @hasrole(['admin', 'staff'])
          <li class="nav-item <?php $page = Session::get('page'); if($page==2){echo "active";} ?>">
            <a class="nav-link" href="{{URL::to('/product_management')}}">
              <i class="material-icons">content_paste</i>
              <p>Quản Lý Hàng Hoá</p>
            </a>
          </li>
          @endhasrole
          @hasrole(['admin'])
          <li class="nav-item <?php $page = Session::get('page'); if($page==3){echo "active";} ?>">
            <a class="nav-link" href="{{URL::to('/staff_management')}}">
              <i class="material-icons">people</i>
              <p>Quản Lý Nhân Viên</p>
            </a>
          </li>
          <li class="nav-item <?php $page = Session::get('page'); if($page==4){echo "active";} ?>">
            <a class="nav-link" href="{{URL::to('/category_management')}}">
              <i class="material-icons">category</i>
              <p>Quản Lý Danh Mục</p>
            </a>
          </li>
          <li class="nav-item <?php $page = Session::get('page'); if($page==13){echo "active";} ?>">
            <a class="nav-link" href="{{URL::to('/show_user')}}">
              <i class="material-icons">people</i>
              <p>Quản Lý Khách Hàng</p>
            </a>
          </li>
          @endhasrole
          @hasrole(['admin', 'staff'])
          <li class="nav-item <?php $page = Session::get('page'); if($page==5){echo "active";} ?>">
            <a class="nav-link" href="{{URL::to('/order_management')}}">
              <i class="material-icons">store</i>
              <p>Quản Lý Đơn Hàng</p>
            </a>
          </li>
          @endhasrole
          @hasrole(['admin'])
          <li class="nav-item <?php $page = Session::get('page'); if($page==6){echo "active";} ?>">
            <a class="nav-link" href="{{URL::to('/catechild_management')}}">
              <i class="material-icons">inventory_2</i>
              <p>Quản lý Danh Mục Con</p>
            </a>
          </li>
          @endhasrole
          @hasrole(['admin', 'stock'])
          <li class="nav-item <?php $page = Session::get('page'); if($page==7){echo "active";} ?>">
            <a class="nav-link" href="{{URL::to('/show_receipt')}}">
              <i class="material-icons">receipt_long</i>
              <p>Quản Lý Nhập Kho</p>
            </a>
          </li>
          @endhasrole
          @hasrole(['admin'])
          <li class="nav-item <?php $page = Session::get('page'); if($page==8){echo "active";} ?>">
            <a class="nav-link" href="{{URL::to('/show_comment')}}">
              <i class="material-icons">notifications</i>
              <p>Thông Báo</p>
            </a>
          </li>
          <li class="nav-item <?php $page = Session::get('page'); if($page==9 || $page==12 || $page==13){echo "active";} ?>">
            <a class="nav-link" data-toggle="collapse" href="#statistics">
              <i class="material-icons">paid</i>
              <p> Thống Kê
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?php $page = Session::get('page'); if($page==9 || $page==12 || $page==13){echo "show";} ?>" id="statistics">
              <ul class="nav">
                <li class="nav-item <?php $page = Session::get('page'); if($page==9){echo "active";} ?>">
                  <a class="nav-link" href="{{URL::to('/show_statistic')}}">
                    <span class="sidebar-mini"><i class="material-icons">insights</i></span>
                    <span class="sidebar-normal">Theo tháng </span>
                  </a>
                </li>
                <li class="nav-item <?php $page = Session::get('page'); if($page==12){echo "active";} ?>">
                  <a class="nav-link" href="{{url('/quantity_statistic')}}">
                    <span class="sidebar-mini"><i class="material-icons">numbers</i></span>
                    <span class="sidebar-normal">Theo số lượng bán ra</span>
                  </a>
                </li>
                {{-- <li class="nav-item <?php $page = Session::get('page'); if($page==13){echo "active";} ?>">
                  <a class="nav-link" href="{{URL::to('/price_statistic')}}">
                    <span class="sidebar-mini"><i class="material-icons">attach_money</i></span>
                    <span class="sidebar-normal">Doanh Thu </span>
                  </a>
                </li> --}}
              </ul>
            </div>
          </li>
          <li class="nav-item <?php $page = Session::get('page'); if($page==10){echo "active";} ?>">
            <a class="nav-link" href="{{route('coupon.index')}}">
              <i class="material-icons">discount</i>
              <p>Khuyến Mãi</p>
            </a>
          </li>
          <li class="nav-item <?php $page = Session::get('page'); if($page==11){echo "active";} ?>">
            <a class="nav-link" href="{{URL::to('/role_management')}}">
              <i class="material-icons">group</i>
              <p>Phân Quyền</p>
            </a>
          </li>
          @endhasrole
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;"></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification" id="count_noti"></span>
                  <p class="d-lg-none d-md-block">
                    Thông Báo
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" id="dropdown_nofi">
                  <a class="dropdown-item" href="#"></a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Tài Khoản
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="{{URL::to('/user')}}">Thông Tin Cá Nhân</a>
                  <a class="dropdown-item" href="{{URL::to('/logout')}}">Đăng Xuất</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="content">
           @yield('admin_content')
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>
          </div>
        </div>
      </footer>
    </div>
  </div>
  
  <!--   Core JS Files   -->
  <script src="{{asset('public/backend/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}" defer=""></script>
  <script src="{{asset('public/backend/assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('public/backend/assets/js/core/bootstrap-material-design.min.js')}}"></script>
  <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
  <!-- Plugin for the momentJs  -->
  <script src="{{asset('public/backend/assets/js/plugins/moment.min.js')}}"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="{{asset('public/backend/assets/js/plugins/sweetalert2.js')}}"></script>
  <!-- Forms Validations Plugin -->
  <script src="{{asset('public/backend/assets/js/plugins/jquery.validate.min.js')}}"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="{{asset('public/backend/assets/js/plugins/jquery.bootstrap-wizard.js')}}"></script>
  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="{{asset('public/backend/assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="{{asset('public/backend/assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="{{asset('public/backend/assets/js/plugins/jquery.dataTables.min.js')}}"></script>
  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="{{asset('public/backend/assets/js/plugins/bootstrap-tagsinput.js')}}"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="{{asset('public/backend/assets/js/plugins/jasny-bootstrap.min.js')}}"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="{{asset('public/backend/assets/js/plugins/fullcalendar.min.js')}}"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="{{asset('public/backend/assets/js/plugins/jquery-jvectormap.js')}}"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{asset('public/backend/assets/js/plugins/nouislider.min.js')}}"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="{{asset('public/backend/assets/js/plugins/arrive.min.js')}}"></script>
  <!--  Google Maps Plugin    -->

  <!-- Chartist JS -->
  <script src="{{asset('public/backend/assets/js/plugins/chartist.min.js')}}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{asset('public/backend/assets/js/plugins/bootstrap-notify.js')}}"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('public/backend/assets/js/material-dashboard.js?v=2.1.2')}}" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
 {{--  <script src="{{asset('public/backend/assets/demo/demo.js')}}"></script> --}}
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // initialise Datetimepicker and Sliders
      md.initFormExtendedDatetimepickers();
      if ($('.slider').length != 0) {
        md.initSliders();
      }
    });
  </script>
  <script>
    function setFormValidation(id) {
      $(id).validate({
        highlight: function(element) {
          $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
          $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
        },
        success: function(element) {
          $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
          $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
        },
        errorPlacement: function(error, element) {
          $(element).closest('.form-group').append(error);
        },
      });
    }
    $(document).ready(function() {
      setFormValidation('#ChangePassword');
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      load_Order();

      function load_Order() {
        $.ajax({
          url: '{{url('/count_order')}}',
          method: "GET",
          dataType: 'JSON',
          data:{},
          success:function(data){
            $('#count_noti').html(data.count);
            $('#dropdown_nofi').html(data.contend);
          }
        });
      }


      $('.btn-find-order').click(function(event) {
        var text_order = $('#find-order-txt').val();
        var _token = $('input[name="_token"]').val();

        $.ajax({
          url: '{{url('/find-order')}}',
          method: "POST",
          data:{
            text: text_order,
            _token: _token },
          success:function(data){
            $('#table-order').html(data);
          }
        });
      });

      $('.btn-save').click(function(event) {
        var id = $(this).data('id'); //MSNV
        var role_admin = $('#role_admin_'+id).is(":checked");
        var role_staff = $('#role_staff_'+id).is(":checked");
        var role_stock = $('#role_stock_'+id).is(":checked");
        var _token = $('input[name="_token"]').val();

        $.ajax({
          url: '{{url('/assign_role')}}',
          method: "POST",
          data:{
            MSNV: id,
            role_admin: role_admin,
            role_staff: role_staff,
            role_stock: role_stock,
            _token: _token },
          success:function(data){
            if(data!=0){
              location.reload();
            }else{
              swal("Cảnh Báo", "Bạn không được thay đổi quyền của bản thân", "error").then(function(){
              location.reload();
              });
            }
          }
        }); 
      });

      $('.btn-choose-shipper').click(function(event) {
        var id_shipper = $('#id_shipper').val() //MSGH
        var id_order = $('#id_order').val();
        var _token = $('input[name="_token"]').val();

        $.ajax({
          url: '{{url('/choose_shipper')}}',
          method: "POST",
          data:{
            MSGH: id_shipper,
            MSDH: id_order,
            _token: _token },
          success:function(data){
            if(data==1){
              swal("", "Chọn nhân viên giao hàng thành công", "success").then(function(){
                location.reload();
              });
            }else{
              swal("Cảnh Báo", "Không thêm thành công", "error").then(function(){
                location.reload();
              });
            }
          }
        }); 
      });

      $('.information').click(function(event) {
        var id = $(this).data('id'); //MSNV
        var _token = $('input[name="_token"]').val();
        $.ajax({
          url: '{{url('/infor_receipt')}}',
          method: "POST",
          data:{
            MaPhieu: id,
            _token: _token },
          success:function(data){
            $('#modalReceipt').html(data);
            $('#infor-receipt').modal("show");
          }
        }); 
      });

      
    });
  </script>
</body>

</html>
