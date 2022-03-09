@extends('welcome')
@section('contend')  

<div class="slider slider-hp-2">
        <div class="ogami-container-fluid">
          <div class="slider_wrapper" data-slick="{&quot;swipe&quot;: false, &quot;setting&quot;: &quot;unslick&quot;}">
            <div class="slider-block" style="background-image: url('{{('public/frontend/assets/images/poster/background_newyear.png')}}')">
              <div class="slider-content">
                <div class="container">
                  <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-md-5 col-xl-6">
                      <div class="slider-text d-flex flex-column align-items-center align-items-md-start">
                        <h5>Chào 2022</h5>
                        <h1 style="color: #d9d926">CHÚC MỪNG<br> NĂM MỚI</h1>
                        </h3><a class="normal-btn" href="">Mua Ngay</a>
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="slider-img"><img src="{{asset('public/frontend/assets/images/homepage01/slider_subbackground_1.png')}}" alt="">
                        <div class="prallax-img">
                          <div id="img-block"><img class="img" src="{{asset('public/frontend/assets/images/poster/newyear.png')}}" alt="" data-depth="1"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="slider-block" style="background-image: url('{{('public/frontend/assets/images/poster/poster2.jpg')}}')">
              <div class="slider-content"> 
                <div class="container">
                  <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-md-5 col-xl-6">
                      <div class="slider-text d-flex flex-column align-items-center align-items-md-start">
                        <h5>Fruit Fresh</h5>
                        <h1>Orange Lemon</h1>
                        <h3>$14.00<span>/ pakage</span></h3><a class="normal-btn" href="">Shop now</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="slider-banner">
            <div class="row">
              <div class="col-12 col-sm-4 col-lg-4"><a href="shop_grid+list_3col.html"><img class="img-fluid" src="{{('public/frontend/assets/images/poster/poster3.jpg')}}" alt=""></a></div>
              <div class="col-12 col-sm-4 col-lg-4"><a href="shop_grid+list_3col.html"><img class="img-fluid" src="{{('public/frontend/assets/images/poster/poster4.jpg')}}" alt=""></a></div>
              <div class="col-12 col-sm-4 col-lg-4"><a href="shop_grid+list_3col.html"><img class="img-fluid" src="{{('public/frontend/assets/images/poster/poster5.jpg')}}" alt=""></a></div>
            </div>
          </div>
        </div>
      </div>
      <!-- End slider-->
      <div class="feature-products feature-products_v2">
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
                          <button class="quickview round-icon-btn" data-id_product={{$val_new->MSSP}}> <i class="far fa-eye"></i></button>
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
                          <button class="quickview round-icon-btn" data-id_product={{$val->MSSP}}> <i class="far fa-eye"></i></button>
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
                          <button class="quickview round-icon-btn" data-id_product={{$val->MSSP}}> <i class="far fa-eye"></i></button>
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
                          <button class="quickview round-icon-btn" data-id_product={{$val->MSSP}}> <i class="far fa-eye"></i></button>
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
                          <button class="quickview round-icon-btn" data-id_product={{$val->MSSP}}> <i class="far fa-eye"></i></button>
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
      <div class="customer-benefit">
        <div class="ogami-container-fluid">
          <div class="benefit-block">
            <div class="our-benefits shadowless benefit-border">
              <div class="row no-gutters">
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
      <!-- End customer benefit-->
      <div class="deal-of-week_v2" style="background-image: url('{{('public/frontend/assets/images/poster/hinh-nen-mau-xanh-ngoc.jpg')}}')">
        <div class="ogami-container-fluid" >
          <div class="container">
            <div class="row align-items-center justify-content-center">
              <div class="col-12 col-lg-6 text-center">
                <div class="dow-info">
                  <h2 class="title">Giảm Giá Trong Tuần</h2>
                  <div class="d-flex justify-content-center" id="event-countdown"></div><a class="normal-btn" href="{{URL::to('/product_discount')}}">Mua Ngay</a>
                </div>
              </div>
              <div class="col-7 col-lg-6">
                <div class="dow-img"><img class="mymove" src="{{('public/frontend/assets/images/poster/lemon.png')}}" alt=""></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End deak of the week v2-->
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
                          <button class="quickview round-icon-btn" data-id_product={{$val->MSSP}}> <i class="far fa-eye"></i></button>
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
                        <button class="quickview round-icon-btn" data-id_product={{$val->MSSP}}> <i class="far fa-eye"></i></button>
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
      <!-- End best seller-->

      <div class="sale-product"> 
        <div class="ogami-container-fluid">
          <div class="sale-product_top">
            <h2 class="title-bb">Sản Phẩm Giảm Giá</h2>
          </div>
          <div class="sale-product_bottom">
            <div class="row">
              @foreach($sale_product as $value)
              <div class="col-12 col-sm-6 col-lg-4 col-lg-3 col-xxl-3 col-xxxl">
                <div class="mini-product">
                  <div class="mini-product_img">
                    <a href="{{URL::to('/product_details/'.$value->MSSP)}}"><img src="{{('public/upload/'.$value->Image)}}" alt="product image"></a>
                  </div>
                  <div class="mini-product_info"> <a href="{{URL::to('/product_details/'.$value->MSSP)}}">{{$value->TenSP}}</a>
                    <p>
                      <?php
                      $GiaSP = number_format($value->Gia, 0, ',', ' ');
                      echo $GiaSP." đ";
                      ?>
                      <del>
                        <?php
                        $GiaSP = number_format($value->Gia*(1-$value->GiamGia), 0, ',', ' ');
                        echo $GiaSP." đ";
                        ?>
                      </del>
                    </p>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <!-- End sale product-->
      <div class="quick-banner_block">
        <div class="ogami-container-fluid">
          <div class="row">
            <div class="col-12 col-lg-6">
              {{-- style="background-image: url('{{('public/frontend/assets/images/poster/poster2.jpg')}}')" --}}
              <div class="quick-banner quick-banner-2" style="background-image: url('{{('public/frontend/assets/images/poster/Hinh-Nen-Trang-10.jpg')}}')">
                <div class="row justify-content-center align-items-center">
                  <div class="col-6 col-md-5">
                    <div class="bannner-img text-center">
                      <img class="img-fluid" src="{{('public/frontend/assets/images/poster/raucu.png')}}" alt="">
                    </div>
                  </div>
                  <div class="col-6 col-md-5">
                    <div class="banner-text big text-center text-md-left">
                      <h3 class="day">RAU CỦ RẤT RẺ<span class="sale">Giảm 50% </span></h3><a class="normal-btn" href="{{URL::to('/category_home/4')}}">Mua Ngay</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="quick-banner quick-banner-3" style="background-image: url('{{('public/frontend/assets/images/poster/tim.jpg')}}')">
                <div class="row justify-content-center align-items-center">
                  <div class="col-6 col-md-5">
                    <div class="bannner-img text-center"><img class="img-fluid" src="{{('public/frontend/assets/images/poster/thit_heo.png')}}" alt=""></div>
                  </div>
                  <div class="col-6 col-md-5">
                    <div class="banner-text big text-center text-md-left">
                      <h3 class="day">Thịt bò tươi sống<span class="sale">Giảm 20%</span></h3><a class="normal-btn" href="{{URL::to('/category_home/2')}}">Mua Ngay</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End quick banner-->
@endsection       