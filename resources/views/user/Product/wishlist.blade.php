@extends('welcome')
@section('contend')  

	<div class="ogami-breadcrumb">
        <div class="container">
          <ul>
            <li> <a class="breadcrumb-link" href="{{URL::to('/home')}}"> <i class="fas fa-home"></i>Trang Chủ</a></li>
            <li> <a class="breadcrumb-link active" href="{{URL::to('/wish_list')}}">Yêu Thích</a></li>
          </ul>
        </div>
      </div>
      <!-- End breadcrumb-->
      <div class="shopping-cart">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="product-table">
                <?php
                $name_user= Session::get('user_name');
                ?>  
                @if($name_user)
                <table class="table table-responsive"> 
                  <colgroup>
                    <col span="1" style="width: 15%">
                    <col span="1" style="width: 30%">
                    <col span="1" style="width: 15%">
                    <col span="1" style="width: 15%">
                    <col span="1" style="width: 15%">
                    <col span="1" style="width: 10%">
                  </colgroup>
                  <thead>
                    <tr>
                      <th class="product-iamge" scope="col">Hình Ảnh</th>
                      <th class="product-name" scope="col">Tên Sản Phẩm</th>
                      <th class="product-price" scope="col">Giá</th>
                      <th class="product-quantity" scope="col">Giảm Giá</th>
                      <th class="product-total" scope="col">Thành Tiền</th>
                      <th class="product-clear" scope="col"> 
                        {{-- <button class="no-round-btn"><i class="icon_close"></i></button> --}}
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($wish_list as $value)
                      <tr>
                        <td class="product-iamge"> 
                          <div class="img-wrapper"><img src="{{('public/upload/'.$value->Image)}}" alt="product image"></div>
                        </td>
                        <td class="product-name">{{$value->TenSP}}</td>
                        <td class="product-price">
                         <?php
                         $GiaSP = number_format($value->Gia, 0, ',', ' ');
                         echo $GiaSP." đ";
                         ?>
                        </td>
                        <td class="product-quantity">{{$value->GiamGia*100}}%</td>
                        <td class="product-total">
                         <?php
                         $GiaSP = number_format($value->Gia*(1-$value->GiamGia), 0, ',', ' ');
                         echo $GiaSP." đ";
                         ?>
                        </td>
                        <td class="product-clear"> 
                          <form>
                            {{csrf_field()}}
                            <button class="no-round-btn del_wishlist" data-id_product={{$value->Ma}}><i class="icon_close"></i></button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
                @else
                <div class="col-12 justify-content-center align-items-center text-center">
                  <h3>Bạn chưa đăng nhập</h3>
                </div>
                @endif
              </div>
            </div>
            <div class="col-12 text-left">
              <a class="normal-btn black cart-update" href="{{URL::to('/home')}}">Tiếp Tục Mua Hàng</a>
            </div>
          </div>
        </div>
    </div>
    <!-- End shopping cart-->

@endsection