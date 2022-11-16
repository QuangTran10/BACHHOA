@extends('welcome')
@section('contend')  

  <?php
    $sort='none';
     if (isset($_GET['sort_by'])) {
      $sort=$_GET['sort_by'];
     } 
  ?>
  <div class="ogami-breadcrumb">
        <div class="ogami-container-fluid">
          <ul>
            <li> <a class="breadcrumb-link" href="{{URL::to('/home')}}"> <i class="fas fa-home"></i>Trang Chủ</a></li>
            <li> <a class="breadcrumb-link active" href="">Sản Phẩm</a></li>
          </ul>
        </div>
      </div>
      <!-- End breadcrumb-->
      <div class="shop-layout">
        <div class="ogami-container-fluid">
          <div class="row">
            <div class="col-xl-3 col-xxl-3 col-xxxl-2">
              <div class="shop-sidebar">
                <button class="no-round-btn" id="filter-sidebar--closebtn">Close sidebar</button>
                <div class="shop-sidebar_department">
                  <div class="department_top mini-tab-title underline">
                    <h2 class="title">DANH MỤC</h2>
                  </div>
                  <div class="department_bottom">
                    <ul>
                      @foreach($category as $key => $val_cate)
                      <li>
                      	<a class="department-link" href="{{URL::to('/category_home/'.$val_cate->MaDM)}}">{{$val_cate->TenDanhMuc}}</a>
                      </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
                <div class="shop-sidebar_price-filter">
                  <div class="price-filter_top mini-tab-title underline">
                    
                  </div>
                  <div class="price-filter_bottom">
                    
                  </div>
                </div>
              </div>
              <div class="filter-sidebar--background" style="display: none"></div>
            </div>
            <div class="col-xl-9 col-xxl-9 col-xxxl-10">
              <div class="shop-grid-list">
                <div class="shop-products">
                  <div class="shop-products_top mini-tab-title underline">
                    <div class="row align-items-center">
                      <div class="col-6 col-xl-4">
                        <h2 class="title">{{$meta_desc}}</h2>
                      </div>
                      <div class="col-6 text-right">
                        <div id="show-filter-sidebar">
                          <h5> <i class="fas fa-bars"></i>Show sidebar</h5>
                        </div>
                      </div>
                      <div class="col-12 col-xl-8">
                        <div class="product-option">
                          <div class="product-filter">
                            
                          </div>
                          <div class="view-method">
                            <p class="active" id="grid-view"><i class="fas fa-th-large"></i></p>
                            <p id="list-view"><i class="fas fa-list"></i></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--Using column-->
                  </div>
                  <div class="shop-products_bottom--fullwidth">
                    <div class="row no-gutters-sm">
                    	@foreach($product as $key => $value)
                    	<div class="col-6 col-md-4 col-xxl-3 col-xxxl">
                    		<div class="product">
                    			<div class="product-img_block"><a class="product-img" href="{{URL::to('/product_details/'.$value->MSSP)}}"><img src="{{asset('public/upload/'.$value->Image)}}" alt=""></a>
                    				<button class="quickview no-round-btn smooth" data-id_product={{$value->MSSP}}><i class="far fa-eye"></i> Xem</button>
                    			</div>
                    			<div class="product-info_block">
                    				<h5 class="product-type">{{$value->TenDanhMuc}}</h5><a class="product-name" href="">{{$value->TenSP}}</a>
                    				<h3 class="product-price">
                              @if($value->TrangThai==1)      
                              @if($value->GiamGia==0)
                                <?php
                                $GiaSP = number_format($value->Gia, 0, ',', ' ');
                                echo $GiaSP." đ";
                                ?>
                              @else
                                <?php
                                $GiaSP = number_format($value->Gia*(1-$value->GiamGia), 0, ',', ' ');
                                echo $GiaSP." đ";
                                ?>
                                <del>
                                  <?php
                                  $GiaSP = number_format($value->Gia, 0, ',', ' ');
                                  echo $GiaSP." đ";
                                  ?>     
                                </del>
                              @endif
                            @else
                              Hết Hàng
                            @endif
                    				</h3>
                    				<h5 class="product-rated"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star-half"></i><span>(5)</span></h5>
                    				<h5 class="product-avaiable">Còn <span>{{$value->SoLuong}} trong kho</span></h5>
                    				<button class="add-to-wishlist button-borderless"><i class="icon_heart_alt"></i></button>
                    			</div>
                          <form>
                            {{csrf_field()}}
                            <input type="hidden" name="Id_{{$value->MSSP}}" value="{{$value->MSSP}}" class="cart_product_id_{{$value->MSSP}}">
                            <input type="hidden" name="Name" value="{{$value->TenSP}}" class="cart_product_name_{{$value->MSSP}}">
                            <input type="hidden" name="Image" value="{{$value->Image}}" class="cart_product_image_{{$value->MSSP}}">
                            <input type="hidden" name="Price" value="{{$value->Gia}}" class="cart_product_price_{{$value->MSSP}}">
                            <input type="hidden" name="Discount" value="{{$value->GiamGia}}" class="cart_product_discount_{{$value->MSSP}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$value->MSSP}}" name="SoLuong">
                          </form>
                    			<div class="product-select">
                    				<button class="add-to-wishlist round-icon-btn"> <i class="icon_heart_alt"></i></button>
                    				<button class="add-to-cart round-icon-btn" data-id="{{$value->MSSP}}" {{($value->TrangThai==0)? "disabled" : "" }}>  <i class="icon_bag_alt"></i></button>
                    				<button class="add-to-compare round-icon-btn"> <i class="fas fa-random"></i></button>
                    			</div>
                    			<div class="product-select_list">
                    				<p class="delivery-status">Miễn Phí Giao Hàng</p>
                    				<h3 class="product-price"> 
                    					@if($value->GiamGia==0)
                                <?php
                                $GiaSP = number_format($value->Gia, 0, ',', ' ');
                                echo $GiaSP." đ";
                                ?>
                              @else
                                <?php
                                $GiaSP = number_format($value->Gia*(1-$value->GiamGia), 0, ',', ' ');
                                echo $GiaSP." đ";
                                ?>
                                <del>
                                  <?php
                                  $GiaSP = number_format($value->Gia, 0, ',', ' ');
                                  echo $GiaSP." đ";
                                  ?>     
                                </del>
                              @endif
                    				</h3>
                    				<button class="add-to-cart normal-btn outline">Thêm Vào Giỏ Hàng</button>
                    				{{-- <button class="add-to-compare normal-btn outline">+ Add to Compare</button> --}}
                    			</div>
                    		</div>
                    	</div>
                      @endforeach
                    </div>
                  </div>
                  <?php
                  if(isset($_GET['key'])){
                    $key = $_GET['key'];
                  }
                  ?>
                  {{$product->appends(['key' => $key])->links('partials.my_paginate')}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End shop layout-->
@endsection