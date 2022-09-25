@extends('welcome')
@section('contend')  

  <div class="slider">
    <div class="full-fluid">
      <div class="slider_wrapper">
        <div class="slider-block" style="background-image: url('{{('public/frontend/assets/images/poster/background-birthday.jpg')}}')">
          <div class="slider-content">
            <div class="container">
              <div class="row align-items-center justify-content-center">
                <div class="col-12 col-md-5 col-xl-6">
                  <div class="slider-text d-flex flex-column align-items-center align-items-md-start">
                    <h5 data-animation="fadeInUp" data-delay=".2s" style="color: red;">Happy Birthday</h5>
                    <h1 data-animation="fadeInUp" data-delay=".3s" style="color: #660066">MỪNG SINH NHẬT<br> 1 TUỔI</h1>
                    <a class="normal-btn" href="" data-animation="fadeInUp" data-delay=".4s">Mua Ngay</a>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="slider-img" data-animation="zoomIn" data-delay=".1s">
                    <img src="{{asset('public/frontend/assets/images/homepage01/slider_subbackground_1.png')}}" alt="">
                    <div class="prallax-img">
                      <div id="img-block"><img class="img" src="{{asset('public/frontend/assets/images/poster/one-year.png')}}" alt="" data-depth="1"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="slider-block" style="background-image: url('{{('public/frontend/assets/images/poster/background-5.jpg')}}')">
          <div class="slider-content"> 
            <div class="container">
              <div class="row align-items-center justify-content-center">
                <div class="col-12 col-md-5 col-xl-6">
                  <div class="slider-text d-flex flex-column align-items-center align-items-md-start">
                    <h5 data-animation="fadeInUp" data-delay=".2s" style="color: white;">Lunar New Year</h5>
                    <h1 data-animation="fadeInUp" data-delay=".3s" style="color: yellow;">CHÚC MỪNG NĂM MỚI</h1>
                    {{-- <h3 data-animation="fadeInUp" data-delay=".4s">$14.00<span>/ pakage</span></h3> --}}
                    <a class="normal-btn" href="" data-animation="fadeInUp" data-delay=".4s">Mua Ngay</a>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="slider-img" data-animation="zoomIn" data-delay=".1s">
                    <img src="{{asset('public/frontend/assets/images/homepage01/slider_subbackground_1.png')}}" alt="">
                    <img class="img" src="{{asset('public/frontend/assets/images/poster/newyear.png')}}" alt=""></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="slider-block" style="background-image: url('{{('public/frontend/assets/images/poster/background-6.png')}}')">
          <div class="slider-content"> 
            <div class="container">
              <div class="row align-items-center justify-content-center">
                <div class="col-12 col-md-5 col-xl-6">
                  <div class="slider-text d-flex flex-column align-items-center align-items-md-start">
                    <h5 data-animation="fadeInUp" data-delay=".2s" style="color: white;">Big Sale</h5>
                    <h1 data-animation="fadeInUp" data-delay=".3s" style="color: #ffff66;">Siêu Sale 12-12</h1>
                    {{-- <h3 data-animation="fadeInUp" data-delay=".4s">$14.00<span>/ pakage</span></h3> --}}
                    <a class="normal-btn" href="" data-animation="fadeInUp" data-delay=".4s">Mua Ngay</a>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="slider-img" data-animation="zoomIn" data-delay=".1s">
                    <img src="{{asset('public/frontend/assets/images/homepage01/slider_subbackground_1.png')}}" alt="">
                    <img class="img" src="{{asset('public/frontend/assets/images/poster/big-sale.png')}}" alt=""></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="slider-block" style="background-image: url('{{('public/frontend/assets/images/poster/background-7.jpg')}}')">
          <div class="slider-content"> 
            <div class="container">
              <div class="row align-items-center justify-content-center">
                <div class="col-12 col-md-5 col-xl-6">
                  <div class="slider-text d-flex flex-column align-items-center align-items-md-start">
                    <h5 data-animation="fadeInUp" data-delay=".2s" style="color: white;" >Merry Christmas</h5>
                    <h1 data-animation="fadeInUp" data-delay=".3s" style="color: #FFD700;">Mừng Giáng Sinh</h1>
                    {{-- <h3 data-animation="fadeInUp" data-delay=".4s">$14.00<span>/ pakage</span></h3> --}}
                    <a class="normal-btn" href="" data-animation="fadeInUp" data-delay=".4s">Mua Ngay</a>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="slider-img" data-animation="zoomIn" data-delay=".1s">
                    <img src="{{asset('public/frontend/assets/images/homepage01/slider_subbackground_1.png')}}" alt="">
                    <img class="img" src="{{asset('public/frontend/assets/images/poster/merry-christmas.png')}}" alt=""></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="benefit-block">
        <div class="container">
          <div class="our-benefits">
            <div class="row">
              <div class="col-12 col-md-6 col-lg-3">
                  <div class="benefit-detail d-flex flex-column align-items-center"><img class="benefit-img" src="{{('public/frontend/assets/images/homepage01/benefit-icon1.png')}}" alt="">
                    <h5 class="benefit-title">Miễn phí giao hàng</h5>
                    <p class="benefit-describle">Cho tất cả đơn hàng trên 1 triệu</p>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                  <div class="benefit-detail d-flex flex-column align-items-center"><img class="benefit-img" src="{{('public/frontend/assets/images/homepage01/benefit-icon2.png')}}" alt="">
                    <h5 class="benefit-title">Phục vụ mọi lúc</h5>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                  <div class="benefit-detail d-flex flex-column align-items-center"><img class="benefit-img" src="{{('public/frontend/assets/images/homepage01/benefit-icon3.png')}}" alt="">
                    <h5 class="benefit-title">Bảo mật thanh toán</h5>
                    <p class="benefit-describle">100% thanh toán an toàn</p>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                  <div class="benefit-detail boderless boderless d-flex flex-column align-items-center"><img class="benefit-img" src="{{('public/frontend/assets/images/homepage01/benefit-icon4.png')}}" alt="">
                    <h5 class="benefit-title">Phục vụ 24/7</h5>
                    <p class="benefit-describle">Hỗ trợ tận tâm</p>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End slider-->
  <div class="items-category">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3"><a class="product-item d-flex flex-column align-items-center justify-content-center" href="shop_grid+list_3col.html">
          <div class="categories-img">
            <img src="{{('public/frontend/assets/images/product/item-1.png')}}" alt=""></div>
          <h2>Nước khoáng Vivant</h2>
          <p>96 000đ</p></a>
        </div>
        <div class="col-12 col-sm-6 col-md-3"><a class="product-item d-flex flex-column align-items-center justify-content-center" href="shop_grid+list_3col.html" >
          <div class="categories-img">
            <img src="{{('public/frontend/assets/images/product/item-2.png')}}" alt=""></div>
          <h2>Nấm mỡ nâu</h2>
          <p>62 100đ</p></a>
        </div>
        <div class="col-12 col-sm-6 col-md-3"><a class="product-item d-flex flex-column align-items-center justify-content-center" href="shop_grid+list_3col.html">
          <div class="categories-img">
            <img src="{{('public/frontend/assets/images/product/item-3.png')}}" alt=""></div>
          <h2>Dưa Lưới</h2>
          <p>49 000đ</p></a>
        </div>
        <div class="col-12 col-sm-6 col-md-3"><a class="product-item d-flex flex-column align-items-center justify-content-center" href="shop_grid+list_3col.html" >
          <div class="categories-img">
            <img src="{{('public/frontend/assets/images/product/item-4.png')}}" alt=""></div>
          <h2>Táo Gala New Zealand</h2>
          <p>49 000đ</p></a>
        </div>
      </div>
    </div>
  </div>
          <!-- End items-category-->
          <div class="feature-products">
            <div class="ogami-container-fluid">
              <div class="row">
                <div class="col-12 text-center">
                  <h1 class="title mx-auto">Sản Phẩm</h1>
                </div>
                <div class="col-12">
                  <div id="tab">
                    <ul class="tab-control">
                      <li><a class="active" href="#tab-1">Mới Nhất</a></li>
                      <li><a href="#tab-2">Thịt</a></li>
                      <li> <a href="#tab-3">Hải Sản</a></li>
                      <li><a href="#tab-4">Rau, củ</a></li>
                      <li><a href="#tab-5">Nước ngọt</a></li>
                    </ul>
                    <div id="tab-1">
                      <div class="row no-gutters-sm">
                        @foreach($new_product as $key => $val_new)
                        <div class="col-6 col-md-4 col-lg-3 col-xxl-2">
                          <div class="product borderless"><a class="product-img" href="{{URL::to('/product_details/'.$val_new->MSSP)}}"><img src="{{('public/upload/'.$val_new->Image)}}" alt=""></a>
                            <h5 class="product-type">{{$val_new->TenDanhMuc}}</h5>
                            <h3 class="product-name">{{$val_new->TenSP}}</h3>
                            <h3 class="product-price">
                              @if($val_new->TrangThai!=0)  
                              @if($val_new->GiamGia==0)
                              <?php
                              $GiaSP = number_format($val_new->Gia, 0, ',', ' ');
                              echo $GiaSP." đ";
                              ?>
                              @else
                              <?php
                              $GiaSP = number_format($val_new->Gia*(1-$val_new->GiamGia), 0, ',', ' ');
                              echo $GiaSP." đ";
                              ?>
                              <del>
                                <?php
                                $GiaSP = number_format($val_new->Gia, 0, ',', ' ');
                                echo $GiaSP." đ";
                                ?>     
                              </del>
                              @endif
                              @else
                              Hết Hàng
                              @endif  
                            </h3>
                            <form>
                              {{csrf_field()}}
                              <input type="hidden" name="Id_{{$val_new->MSSP}}" value="{{$val_new->MSSP}}" class="cart_product_id_{{$val_new->MSSP}}">
                              <input type="hidden" name="Name" value="{{$val_new->TenSP}}" class="cart_product_name_{{$val_new->MSSP}}">
                              <input type="hidden" name="Image" value="{{$val_new->Image}}" class="cart_product_image_{{$val_new->MSSP}}">
                              <input type="hidden" name="Price" value="{{$val_new->Gia}}" class="cart_product_price_{{$val_new->MSSP}}">
                              <input type="hidden" name="Discount" value="{{$val_new->GiamGia}}" class="cart_product_discount_{{$val_new->MSSP}}">
                              <input type="hidden" value="1" class="cart_product_qty_{{$val_new->MSSP}}" name="SoLuong">
                            </form>
                            <div class="product-select">
                              <button class="add-to-wishlist round-icon-btn" data-id_product={{$val_new->MSSP}}> <i class="icon_heart_alt"></i></button>
                              <button class="add-to-cart round-icon-btn" data-id="{{$val_new->MSSP}}" name="add_cart"><i class="icon_bag_alt"></i></button>
                              <button class="add-to-compare round-icon-btn"> <i class="fas fa-random"></i></button>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                    <div id="tab-2">
                      <div class="row no-gutters-sm">
                        @foreach($meat as $key => $val)
                        <div class="col-6 col-md-4 col-lg-3 col-xxl-2">
                          <div class="product borderless"><a class="product-img" href="{{URL::to('/product_details/'.$val->MSSP)}}"><img src="{{('public/upload/'.$val->Image)}}" alt=""></a>
                            <h5 class="product-type">{{$val->TenDanhMuc}}</h5>
                            <h3 class="product-name">{{$val->TenSP}}</h3>
                            <h3 class="product-price">
                              @if($val->TrangThai!=0)    
                              @if($val->GiamGia==0)
                              <?php
                              $GiaSP = number_format($val->Gia, 0, ',', ' ');
                              echo $GiaSP." đ";
                              ?>
                              @else
                              <?php
                              $GiaSP = number_format($val->Gia*(1-$val->GiamGia), 0, ',', ' ');
                              echo $GiaSP." đ";
                              ?>
                              <del>
                                <?php
                                $GiaSP = number_format($val->Gia, 0, ',', ' ');
                                echo $GiaSP." đ";
                                ?>     
                              </del>
                              @endif
                              @else
                              Hết Hàng
                              @endif  
                            </h3>
                            <form>
                              {{csrf_field()}}
                              <input type="hidden" name="Id_{{$val->MSSP}}" value="{{$val->MSSP}}" class="cart_product_id_{{$val->MSSP}}">
                              <input type="hidden" name="Name" value="{{$val->TenSP}}" class="cart_product_name_{{$val->MSSP}}">
                              <input type="hidden" name="Image" value="{{$val->Image}}" class="cart_product_image_{{$val->MSSP}}">
                              <input type="hidden" name="Price" value="{{$val->Gia}}" class="cart_product_price_{{$val->MSSP}}">
                              <input type="hidden" name="Discount" value="{{$val->GiamGia}}" class="cart_product_discount_{{$val->MSSP}}">
                              <input type="hidden" value="1" class="cart_product_qty_{{$val->MSSP}}" name="SoLuong">
                            </form>
                            <div class="product-select">
                              <button class="add-to-wishlist round-icon-btn" data-id_product={{$val->MSSP}}> <i class="icon_heart_alt"></i></button>
                              <button class="add-to-cart round-icon-btn" data-id="{{$val->MSSP}}" name="add_cart"><i class="icon_bag_alt"></i></button>
                              <button class="add-to-compare round-icon-btn"> <i class="fas fa-random"></i></button>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                    <div id="tab-3"> 
                      <div class="row no-gutters-sm">
                        @foreach($seafood as $key => $val)
                        <div class="col-6 col-md-4 col-lg-3 col-xxl-2">
                          <div class="product borderless"><a class="product-img" href="{{URL::to('/product_details/'.$val->MSSP)}}"><img src="{{('public/upload/'.$val->Image)}}" alt=""></a>
                            <h5 class="product-type">{{$val->TenDanhMuc}}</h5>
                            <h3 class="product-name">{{$val->TenSP}}</h3>
                            <h3 class="product-price">
                              @if($val->TrangThai!=0)    
                              @if($val->GiamGia==0)
                              <?php
                              $GiaSP = number_format($val->Gia, 0, ',', ' ');
                              echo $GiaSP." đ";
                              ?>
                              @else
                              <?php
                              $GiaSP = number_format($val->Gia*(1-$val->GiamGia), 0, ',', ' ');
                              echo $GiaSP." đ";
                              ?>
                              <del>
                                <?php
                                $GiaSP = number_format($val->Gia, 0, ',', ' ');
                                echo $GiaSP." đ";
                                ?>     
                              </del>
                              @endif
                              @else
                              Hết Hàng
                              @endif
                            </h3>
                            <form>
                              {{csrf_field()}}
                              <input type="hidden" name="Id_{{$val->MSSP}}" value="{{$val->MSSP}}" class="cart_product_id_{{$val->MSSP}}">
                              <input type="hidden" name="Name" value="{{$val->TenSP}}" class="cart_product_name_{{$val->MSSP}}">
                              <input type="hidden" name="Image" value="{{$val->Image}}" class="cart_product_image_{{$val->MSSP}}">
                              <input type="hidden" name="Price" value="{{$val->Gia}}" class="cart_product_price_{{$val->MSSP}}">
                              <input type="hidden" name="Discount" value="{{$val->GiamGia}}" class="cart_product_discount_{{$val->MSSP}}">
                              <input type="hidden" value="1" class="cart_product_qty_{{$val->MSSP}}" name="SoLuong">
                            </form>
                            <div class="product-select">
                              <button class="add-to-wishlist round-icon-btn" data-id_product={{$val->MSSP}}> <i class="icon_heart_alt"></i></button>
                              <button class="add-to-cart round-icon-btn" data-id="{{$val->MSSP}}" name="add_cart"><i class="icon_bag_alt"></i></button>
                              <button class="add-to-compare round-icon-btn"> <i class="fas fa-random"></i></button>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                    <div id="tab-4">
                      <div class="row no-gutters-sm">
                        @foreach($vegetables as $key => $val)
                        <div class="col-6 col-md-4 col-lg-3 col-xxl-2">
                          <div class="product borderless"><a class="product-img" href="{{URL::to('/product_details/'.$val->MSSP)}}"><img src="{{('public/upload/'.$val->Image)}}" alt=""></a>
                            <h5 class="product-type">{{$val->TenDanhMuc}}</h5>
                            <h3 class="product-name">{{$val->TenSP}}</h3>
                            <h3 class="product-price">
                              @if($val->TrangThai!=0)    
                              @if($val->GiamGia==0)
                              <?php
                              $GiaSP = number_format($val->Gia, 0, ',', ' ');
                              echo $GiaSP." đ";
                              ?>
                              @else
                              <?php
                              $GiaSP = number_format($val->Gia*(1-$val->GiamGia), 0, ',', ' ');
                              echo $GiaSP." đ";
                              ?>
                              <del>
                                <?php
                                $GiaSP = number_format($val->Gia, 0, ',', ' ');
                                echo $GiaSP." đ";
                                ?>     
                              </del>
                              @endif
                              @else
                              Hết Hàng
                              @endif
                            </h3>
                            <form>
                              {{csrf_field()}}
                              <input type="hidden" name="Id_{{$val->MSSP}}" value="{{$val->MSSP}}" class="cart_product_id_{{$val->MSSP}}">
                              <input type="hidden" name="Name" value="{{$val->TenSP}}" class="cart_product_name_{{$val->MSSP}}">
                              <input type="hidden" name="Image" value="{{$val->Image}}" class="cart_product_image_{{$val->MSSP}}">
                              <input type="hidden" name="Price" value="{{$val->Gia}}" class="cart_product_price_{{$val->MSSP}}">
                              <input type="hidden" name="Discount" value="{{$val->GiamGia}}" class="cart_product_discount_{{$val->MSSP}}">
                              <input type="hidden" value="1" class="cart_product_qty_{{$val->MSSP}}" name="SoLuong">
                            </form>
                            <div class="product-select">
                              <button class="add-to-wishlist round-icon-btn" data-id_product={{$val->MSSP}}> <i class="icon_heart_alt"></i></button>
                              <button class="add-to-cart round-icon-btn" data-id="{{$val->MSSP}}" name="add_cart">  <i class="icon_bag_alt"></i></button>
                              <button class="add-to-compare round-icon-btn"> <i class="fas fa-random"></i></button>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                    <div id="tab-5">
                      <div class="row no-gutters-sm">
                        @foreach($drinks as $key => $val)
                        <div class="col-6 col-md-4 col-lg-3 col-xxl-2">
                          <div class="product borderless"><a class="product-img" href="{{URL::to('/product_details/'.$val->MSSP)}}"><img src="{{('public/upload/'.$val->Image)}}" alt=""></a>
                            <h5 class="product-type">{{$val->TenDanhMuc}}</h5>
                            <h3 class="product-name">{{$val->TenSP}}</h3>
                            <h3 class="product-price">
                              @if($val->TrangThai!=0)    
                              @if($val->GiamGia==0)
                              <?php
                              $GiaSP = number_format($val->Gia, 0, ',', ' ');
                              echo $GiaSP." đ";
                              ?>
                              @else
                              <?php
                              $GiaSP = number_format($val->Gia*(1-$val->GiamGia), 0, ',', ' ');
                              echo $GiaSP." đ";
                              ?>
                              <del>
                                <?php
                                $GiaSP = number_format($val->Gia, 0, ',', ' ');
                                echo $GiaSP." đ";
                                ?>     
                              </del>
                              @endif
                              @else
                              Hết Hàng
                              @endif
                            </h3>
                            <form>
                              {{csrf_field()}}
                              <input type="hidden" name="Id_{{$val->MSSP}}" value="{{$val->MSSP}}" class="cart_product_id_{{$val->MSSP}}">
                              <input type="hidden" name="Name" value="{{$val->TenSP}}" class="cart_product_name_{{$val->MSSP}}">
                              <input type="hidden" name="Image" value="{{$val->Image}}" class="cart_product_image_{{$val->MSSP}}">
                              <input type="hidden" name="Price" value="{{$val->Gia}}" class="cart_product_price_{{$val->MSSP}}">
                              <input type="hidden" name="Discount" value="{{$val->GiamGia}}" class="cart_product_discount_{{$val->MSSP}}">
                              <input type="hidden" value="1" class="cart_product_qty_{{$val->MSSP}}" name="SoLuong">
                            </form>
                            <div class="product-select">
                              <button class="add-to-wishlist round-icon-btn" data-id_product={{$val->MSSP}}> <i class="icon_heart_alt"></i></button>
                              <button class="add-to-cart round-icon-btn" data-id="{{$val->MSSP}}" name="add_cart">  <i class="icon_bag_alt"></i></button>
                              <button class="add-to-compare round-icon-btn"> <i class="fas fa-random"></i></button>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End feature-products-->
          <div class="best-seller">
            <div class="ogami-container-fluid">
              <div id="tab-so1">
                <div class="best-seller_top mini-tab-title">
                  <div class="row align-items-md-center">
                    <div class="col-12 col-md-4 text-center text-md-left">
                      <h2 class="title">Sản Phẩm Bán Chạy</h2>
                    </div>
                    <div class="col-12 col-md-8 text-lg-right">
                    </div>
                  </div>
                </div>
                <div class="best-seller_bottom">
                  <div id="tab1">
                    <div class="row no-gutters-sm">
                      @foreach($pro_best_seller as $key => $val)
                      <div class="col-6 col-md-4 col-lg-3 col-xxl-2">
                        <div class="product borderless"><a class="product-img" href="{{URL::to('/product_details/'.$val->MSSP)}}"><img src="{{('public/upload/'.$val->Image)}}" alt=""></a>
                          <h5 class="product-type">{{$val->TenDanhMuc}}</h5>
                          <h3 class="product-name">{{$val->TenSP}}</h3>
                          <h3 class="product-price">
                            @if($val->TrangThai!=0)    
                            @if($val->GiamGia==0)
                            <?php
                            $GiaSP = number_format($val->Gia, 0, ',', ' ');
                            echo $GiaSP." đ";
                            ?>
                            @else
                            <?php
                            $GiaSP = number_format($val->Gia*(1-$val->GiamGia), 0, ',', ' ');
                            echo $GiaSP." đ";
                            ?>
                            <del>
                              <?php
                              $GiaSP = number_format($val->Gia, 0, ',', ' ');
                              echo $GiaSP." đ";
                              ?>     
                            </del>
                            @endif
                            @else
                            Hết Hàng
                            @endif
                          </h3>
                          <form>
                            {{csrf_field()}}
                            <input type="hidden" name="Id_{{$val->MSSP}}" value="{{$val->MSSP}}" class="cart_product_id_{{$val->MSSP}}">
                            <input type="hidden" name="Name" value="{{$val->TenSP}}" class="cart_product_name_{{$val->MSSP}}">
                            <input type="hidden" name="Image" value="{{$val->Image}}" class="cart_product_image_{{$val->MSSP}}">
                            <input type="hidden" name="Price" value="{{$val->Gia}}" class="cart_product_price_{{$val->MSSP}}">
                            <input type="hidden" name="Discount" value="{{$val->GiamGia}}" class="cart_product_discount_{{$val->MSSP}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$val->MSSP}}" name="SoLuong">
                          </form>
                          <div class="product-select">
                            <button class="add-to-wishlist round-icon-btn" data-id_product={{$val->MSSP}}> <i class="icon_heart_alt"></i></button>
                            <button class="add-to-cart round-icon-btn" data-id="{{$val->MSSP}}" name="add_cart">  <i class="icon_bag_alt"></i></button>
                            <button class="add-to-compare round-icon-btn"> <i class="fas fa-random"></i></button>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
              <div id="tab-so2">
                <div class="best-seller_top mini-tab-title">
                  <div class="row align-items-md-center">
                    <div class="col-12 col-md-4 text-center text-md-left">
                      <h2 class="title">Sản Phẩm Nổi Bật</h2>
                    </div>
                    <div class="col-12 col-md-8 text-lg-right">
                    </div>
                  </div>
                </div>
                <div class="best-seller_bottom">
                  <div id="tab1">
                    <div class="row no-gutters-sm">
                      @foreach( $product_rate as $key => $val)
                      <div class="col-6 col-md-4 col-lg-3 col-xxl-2">
                        <div class="product borderless"><a class="product-img" href="{{URL::to('/product_details/'.$val->MSSP)}}"><img src="{{('public/upload/'.$val->Image)}}" alt=""></a>
                          <h5 class="product-type">{{$val->TenDanhMuc}}</h5>
                          <h3 class="product-name">{{$val->TenSP}}</h3>
                          <h3 class="product-price">
                            @if($val->TrangThai!=0)    
                            @if($val->GiamGia==0)
                            <?php
                            $GiaSP = number_format($val->Gia, 0, ',', ' ');
                            echo $GiaSP." đ";
                            ?>
                            @else
                            <?php
                            $GiaSP = number_format($val->Gia*(1-$val->GiamGia), 0, ',', ' ');
                            echo $GiaSP." đ";
                            ?>
                            <del>
                              <?php
                              $GiaSP = number_format($val->Gia, 0, ',', ' ');
                              echo $GiaSP." đ";
                              ?>     
                            </del>
                            @endif
                            @else
                            Hết Hàng
                            @endif
                          </h3>
                          <form>
                            {{csrf_field()}}
                            <input type="hidden" name="Id_{{$val->MSSP}}" value="{{$val->MSSP}}" class="cart_product_id_{{$val->MSSP}}">
                            <input type="hidden" name="Name" value="{{$val->TenSP}}" class="cart_product_name_{{$val->MSSP}}">
                            <input type="hidden" name="Image" value="{{$val->Image}}" class="cart_product_image_{{$val->MSSP}}">
                            <input type="hidden" name="Price" value="{{$val->Gia}}" class="cart_product_price_{{$val->MSSP}}">
                            <input type="hidden" name="Discount" value="{{$val->GiamGia}}" class="cart_product_discount_{{$val->MSSP}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$val->MSSP}}" name="SoLuong">
                          </form>
                          <div class="product-select">
                            <button class="add-to-wishlist round-icon-btn" data-id_product={{$val->MSSP}}> <i class="icon_heart_alt"></i></button>
                            <button class="add-to-cart round-icon-btn" data-id="{{$val->MSSP}}" name="add_cart">  <i class="icon_bag_alt"></i></button>
                            <button class="add-to-compare round-icon-btn"> <i class="fas fa-random"></i></button>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>    
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="banner"> 
            <div class="full-fluid">
              <div class="banner-block">
                <div class="row no-gutters">
                  <div class="col-12 col-lg-3">
                    <div class="banner-block_detail" style="background-image: url('{{('public/frontend/assets/images/poster/nen-2.jpg')}}')">
                      <img src="{{('public/frontend/assets/images/poster/deal-2.png')}}" alt="">
                      <a class="banner-btn normal-btn" href="">Mua Ngay</a></div>
                  </div>
                  <div class="col-12 col-lg-6">
                    <div class="banner-block_detail" style="background-image: url('{{('public/frontend/assets/images/poster/nen-2.jpg')}}')">
                      <img src="{{('public/frontend/assets/images/poster/deal-1.jpg')}}" alt="">
                      <a class="banner-btn normal-btn" href="">Mua Ngay</a></div>
                  </div>
                  <div class="col-12 col-lg-3">
                    <div class="banner-block_detail" style="background-image: url('{{('public/frontend/assets/images/poster/nen-2.jpg')}}')">
                      <img src="{{('public/frontend/assets/images/poster/deal-3.png')}}" alt="">
                      <a class="banner-btn normal-btn" href="">Mua Ngay</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End banner -->
          <div class="deal-of-week">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-12 text-center order-1">
                  <h1 class="title green-underline mx-auto">Deal Of The Week</h1>
                </div>
                <div class="col-10 col-md-6 col-lg-4 order-3 order-md-2 order-lg-2">
                  <div class="row">
                    <div class="col-12">
                      <div class="featured-use text-md-right">
                        <div class="featured-use_intro order-2 order-md-1">
                          <h5>Eat Healthier</h5>
                          <p>Modi tempora incidunt ut labore dolore magnam aliquam</p>
                        </div>
                        <div class="featured-use_icon text-md-right order-1 order-md-2 featured-use_icon-left">
                          <div class="icon-detail"><img src="assets/images/homepage01/dow_icon_1.png" alt=""></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="featured-use text-md-right">
                        <div class="featured-use_intro order-2 order-md-1">
                          <h5>We Have Brands</h5>
                          <p>Modi tempora incidunt ut labore dolore magnam aliquam</p>
                        </div>
                        <div class="featured-use_icon text-md-right order-1 order-md-2 featured-use_icon-left">
                          <div class="icon-detail"><img src="assets/images/homepage01/dow_icon_2.png" alt=""></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4 order-2 order-md-4 order-lg-3 text-center">
                  <div class="week-product_img"><img class="img-fluid" src="assets/images/homepage01/deal-of-week.png" alt="">
                    <p>Only<br><span>$19.00</span></p>
                  </div>
                </div>
                <div class="col-10 col-md-6 col-lg-4 order-4 order-md-3 order-lg-4">
                  <div class="row">
                    <div class="col-12">
                      <div class="featured-use">
                        <div class="featured-use_intro order-2">
                          <h5>Fresh And Clean Products</h5>
                          <p>Modi tempora incidunt ut labore dolore magnam aliquam</p>
                        </div>
                        <div class="featured-use_icon order-1 ml-0">
                          <div class="icon-detail"><img src="assets/images/homepage01/dow_icon_3.png" alt=""></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="featured-use">
                        <div class="featured-use_intro order-2">
                          <h5>Modern Process</h5>
                          <p>Modi tempora incidunt ut labore dolore magnam aliquam</p>
                        </div>
                        <div class="featured-use_icon order-1 ml-0">
                          <div class="icon-detail"><img src="assets/images/homepage01/dow_icon_4.png" alt=""></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 text-center order-5">
                  <div class="d-flex justify-content-center" id="event-countdown"></div>
                </div>
              </div>
            </div>
          </div>
          <!-- End deak of the week-->
@endsection       