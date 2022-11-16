@extends('welcome')
@section('contend')
@php
 use Carbon\Carbon;
@endphp   
<div class="ogami-breadcrumb">
  <div class="ogami-container-fluid">
    <ul>
      <li> <a class="breadcrumb-link" href="{{URL::to('/home')}}"> <i class="fas fa-home"></i>Trang Chủ</a></li>
      <li> <a class="breadcrumb-link" href="{{URL::to('/category_home/'.$product_detail->MaDM)}}">{{$product_detail->TenDanhMuc}}</a></li>
      <li> <a class="breadcrumb-link active" href="">{{$product_detail->TenSP}}</a></li>
    </ul>
  </div>
</div>
<!-- End breadcrumb-->
<div class="shop-layout">
  <div class="ogami-container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="shop-detail shop-detail-fullwidth">
          <div class="row">
            <div class="col-12 col-xl-5">
              <div class="shop-detail_img">
                <button class="round-icon-btn" id="zoom-btn"> <i class="icon_zoom-in_alt"></i></button>
                <div class="row">
                  <div class="col-3">
                    <div class="slide-img" data-slick="{&quot;vertical&quot;: true}">
                      <div class="slide-img_block"><img src="{{asset('public/upload/'.$product_detail->Image)}}" alt="product image"></div>
                      @foreach($images_product as $image)
                      <div class="slide-img_block"><img src="{{asset('public/upload/'.$image->HinhAnh)}}" alt="product image"></div>
                      @endforeach
                    </div>
                  </div>
                  <div class="col-9">
                    <div class="big-img">
                      <div class="big-img_block"><img src="{{asset('public/upload/'.$product_detail->Image)}}" alt="product image"></div>
                      @foreach($images_product as $image)
                      <div class="big-img_block"><img src="{{asset('public/upload/'.$image->HinhAnh)}}" alt="product image"></div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
              <div class="img_control"></div>
            </div>
            <div class="col-12 col-xl-7">
              <div class="row">
                <div class="col-md-7 col-lg-7 col-xxl-8">
                  <div class="shop-detail_info">
                    <h5 class="product-type color-type">{{$product_detail->TenDanhMuc}}</h5>
                    <h2 class="product-name">{{$product_detail->TenSP}}</h2>
                    <div class="product-describe_block">
                      <p class="product-describe">
                       <?php echo $product_detail->ThongTin ?>
                     </p>
                   </div>
                   <div class="product-share">
                   </div>
                 </div>
               </div>
               <div class="col-md-5 col-lg-5 col-xxl-4">
                <div class="shop-detail_info shop-detail_info-full">
                  <p class="delivery-status">Miễn Phí Giao Hàng</p>
                  <div class="price-rate">
                    <h3 class="product-price"> 
                      @if($product_detail->GiamGia==0)
                      <?php
                      $GiaSP = number_format($product_detail->Gia, 0, ',', ' ');
                      echo $GiaSP." đ";
                      ?>
                      @else
                      <?php
                      $GiaSP = number_format($product_detail->Gia*(1-$product_detail->GiamGia), 0, ',', ' ');
                      echo $GiaSP." đ";
                      ?>
                      <del>
                        <?php
                        $GiaSP = number_format($product_detail->Gia, 0, ',', ' ');
                        echo $GiaSP." đ";
                        ?>     
                      </del>
                      @endif
                    </h3>
                    
                    <h5 class="product-rated">
                      @for($i = 1; $i <= $Total; $i++)
                      <i class="icon_star"></i>
                      @endfor
                      <span>({{$count_reviews}})</span></h5>
                      <h5 class="product-rated"><span>Còn {{$product_detail->SoLuong}} sản phẩm trong kho</span></h5>
                    </div>
                    <form>
                      {{csrf_field()}}
                      <div class="quantity-select">
                        <label for="quantity">Số Lượng:</label>
                        <input type="hidden" name="Id_{{$product_detail->MSSP}}" value="{{$product_detail->MSSP}}" class="cart_product_id_{{$product_detail->MSSP}}">
                        <input type="hidden" name="Name" value="{{$product_detail->TenSP}}" class="cart_product_name_{{$product_detail->MSSP}}">
                        <input type="hidden" name="Image" value="{{$product_detail->Image}}" class="cart_product_image_{{$product_detail->MSSP}}">
                        <input type="hidden" name="Price" value="{{$product_detail->Gia}}" class="cart_product_price_{{$product_detail->MSSP}}">
                        <input type="hidden" name="Discount" value="{{$product_detail->GiamGia}}" class="cart_product_discount_{{$product_detail->MSSP}}">
                        <input type="number" min="1" value="1" class="cart_product_qty_{{$product_detail->MSSP}}" name="SoLuong">
                      </div>
                      <div class="product-select">
                        @if($product_detail->SoLuong==0)
                        <input type="button" data-id="{{$product_detail->MSSP}}" class="add-to-cart normal-btn outline" name="add_cart" value="Hết Hàng" disabled>
                        @else
                        <input type="button" data-id="{{$product_detail->MSSP}}" class="add-to-cart normal-btn outline" name="add_cart" value="Thêm vào giỏ hàng" <?php if($product_detail->SoLuong==0) echo 'disabled="disabled"';?>>
                        @endif
                      </div>  
                    </form>
                    
                    <div class="product-guarante">
                      <p class="guarante">Đảm bảo 100% sự hài lòng</p>
                      <p class="guarante">Miễn phí giao hàng khi mua từ 1 triệu</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="shop-detail_more-info">
                <div id="tab-so3">
                  <ul class="mb-0">
                    <li class="active"><a href="#tab-1">Mô Tả</a></li>
                    <li><a href="#tab-2">Bình Luận</a></li>
                  </ul>
                  <div id="tab-1">
                    <div class="description-block">
                      <div class="description-item_block">
                        <div class="row align-items-center justify-content-around">
                          <div class="col-12 col-md-4">
                            <div class="description-item_img"><img class="img-fluid" src="{{asset('public/upload/'.$product_detail->Image)}}" alt="description image"></div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="description-item_text">
                              <h2>Thông tin sản phẩm</h2>
                              <p><?php echo $product_detail->ThongTin ?></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="tab-2"> 
                    <div class="customer-reviews_block">
                      <div id="review">
                        @foreach($comments as $value)
                        <div class="customer-review">
                          <div class="row">
                            <div class="col-12 col-sm-3 col-lg-2 col-xxl-1">
                              <div class="customer-review_left">
                                <div class="customer-review_img text-center">
                                  <img class="img-fluid" src="{{asset("public/frontend/assets/images/Avatar/avatar.jpeg")}}" alt="customer image">
                                </div>
                                <div class="customer-rate">
                                  @for($i = 1; $i<=$value->DanhGia;$i++)
                                  <i class="icon_star"></i>
                                  @endfor
                                </div>
                              </div>
                            </div>
                            <div class="col-12 col-sm-9 col-lg-10 col-xxl-11">
                              <div class="customer-comment"> 
                                <h5 class="comment-date">{{Carbon::parse($value->ThoiGian)->format('d/m/Y')}}</h5>
                                <h3 class="customer-name">{{$value->HoTenKH}}</h3>
                                <p class="customer-commented">{{$value->NoiDung}}</p>
                              </div>
                            </div>
                          </div> 
                        </div>
                        @endforeach
                      </div>
                      <div class="add-review">
                        <div class="add-review_top">
                          <h2>Thêm Đánh Giá</h2>
                        </div>
                        <div class="add-review_bottom">
                          <form>
                            {{csrf_field()}}
                            <input type="hidden" name="MSSP" value="{{$product_detail->MSSP}}" class="cmt_pro_id">
                            <div class="row">
                              <div class="col-12">
                                <div class="rating">
                                  <div class="row">
                                    <div class="col-md-2">
                                      <label class="col-form-label"><span class="text-danger">*</span>
                                      Đánh Giá</label>
                                    </div>
                                    <div class="col-md-5">
                                      <div class="stars">
                                        <input class="star star-5" id="star-5" type="radio" name="star" value="5"/>
                                        <label class="star star-5" for="star-5"></label>
                                        <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
                                        <label class="star star-4" for="star-4"></label>
                                        <input class="star star-3" id="star-3" type="radio" name="star" value="3" />
                                        <label class="star star-3" for="star-3"></label>
                                        <input class="star star-2" id="star-2" type="radio" name="star" value="2" />
                                        <label class="star star-2" for="star-2"></label>
                                        <input class="star star-1" id="star-1" type="radio" name="star" value="1" />
                                        <label class="star star-1" for="star-1"></label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <textarea class="textarea-form cmt_content" id="review" cols="30" rows="5"></textarea>
                              </div>
                            </div>
                          </form>
                          <div class="col-12">
                            <button class="normal-btn cmt_add">Thêm Đánh Giá</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="col-12">
        <div class="related-product">
          <div class="related-product_top mini-tab-title underline">
            <h2 class="title">Sản Phẩm Liên Quan</h2>
          </div>
          <div class="related-product_bottom">
            <div class="row no-gutters-sm">
              @foreach($related_product as $key => $val)
              <div class="col-6 col-md-4 col-lg-3 col-xxl-2">
                <div class="product borderless"><a class="product-img" href="{{URL::to('/product_details/'.$val->MSSP)}}"><img src="{{asset('public/upload/'.$val->Image)}}" alt=""></a>
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
                    <button class="add-to-cart round-icon-btn" data-id="{{$val->MSSP}}">  <i class="icon_bag_alt"></i></button>
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
<!-- End shop layout-->
@endsection