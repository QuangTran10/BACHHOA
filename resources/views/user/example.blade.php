@extends('welcome')
@section('contend')

<div class="ogami-breadcrumb">
  <div class="container">
    <ul>
      <li> <a class="breadcrumb-link" href="{{URL::to('/home')}}"> <i class="fas fa-home"></i>Trang Chủ</a></li>
      <li> <a class="breadcrumb-link active" href="{{URL::to('/show_order')}}">Đơn Hàng Của Tôi</a></li>
    </ul>
  </div>
</div> 

<div class="feature-products feature-products_v2">
  <div class="ogami-container-fluid">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="title mx-auto">ĐƠN HÀNG CỦA TÔI</h1>
      </div>
      <div class="col-12">
        <div id="tab">
          <ul class="tab-control">
            <li><a class="active" href="#tab-1">Trả Hàng</a></li>
            <li><a href="#tab-2">Chờ</a></li>
          </ul>

          <div id="tab-1">
            <div class="no-gutters-sm">
              <div class="order-history container">
                <div class="order-table">
                  <table class="table"> 
                    <colgroup>
                      <col span="1" style="width: 20%">
                      <col span="1" style="width: 30%">
                      <col span="1" style="width: 15%">
                      <col span="1" style="width: 15%">
                      <col span="1" style="width: 20%">
                    </colgroup>
                    <tr>
                      <th colspan="2" style="text-align: left;">Đơn hàng #1</th>
                      <th colspan="3" style="text-align: right;">ĐÃ HUỶ</th>
                    </tr>
                    <tbody>
                      <tr>
                        <td class="order-image"> 
                          <div class="img-order"><img src="{{('public/upload/thung-24-lon-nuoc-ngot-co-ga-mirinda-vi-soda-kem-viet-quat1652576526.jpg')}}" alt="product image"></div>
                        </td>
                        <td class="order-name">Pure Pineapple</td>
                        <td class="order-price">$460.00</td>
                        <td class="order-quantity"> 
                          <input class="quantity no-round-input" type="number" min="1" value="1">
                        </td>
                        <td class="order-total">$460.00</td>
                      </tr>
                      <tr>
                        <td class="order-image"> 
                          <div class="img-order"><img src="assets/images/product/product02.png" alt="product image"></div>
                        </td>
                        <td class="order-name">American lobster</td>
                        <td class="order-price">$460.00</td>
                        <td class="order-quantity"> 
                          <input class="quantity no-round-input" type="number" min="1" value="1">
                        </td>
                        <td class="order-total">$460.00</td>
                      </tr>
                      <tr>
                        <td class="order-image"> 
                          <div class="img-order"><img src="assets/images/product/product05.png" alt="product image"></div>
                        </td>
                        <td class="order-name">Chrysanthemum</td>
                        <td class="order-price">$460.00</td>
                        <td class="order-quantity">
                          <input class="quantity no-round-input" type="number" min="1" value="2">
                        </td>
                        <td class="order-total">$920.00</td>
                      </tr>
                    </tbody>
                    <tr>
                      <td colspan="2"></td>
                      <td class="order-header" colspan="3">Tổng số tiền: 500 000vnd</td>
                    </tr>
                  </table>
                  <table class="table"> 
                    <colgroup>
                      <col span="1" style="width: 20%">
                      <col span="1" style="width: 30%">
                      <col span="1" style="width: 15%">
                      <col span="1" style="width: 15%">
                      <col span="1" style="width: 20%">
                    </colgroup>
                    <tr>
                      <th colspan="2" style="text-align: left;">Đơn hàng #1</th>
                      <th colspan="3" style="text-align: right;">ĐÃ HUỶ</th>
                    </tr>
                    <tbody>
                      <tr>
                        <td class="order-image"> 
                          <div class="img-order"><img src="{{('public/upload/thung-24-lon-nuoc-ngot-co-ga-mirinda-vi-soda-kem-viet-quat1652576526.jpg')}}" alt="product image"></div>
                        </td>
                        <td class="order-name">Pure Pineapple</td>
                        <td class="order-price">$460.00</td>
                        <td class="order-quantity"> 
                          <input class="quantity no-round-input" type="number" min="1" value="1">
                        </td>
                        <td class="order-total">$460.00</td>
                      </tr>
                      <tr>
                        <td class="order-image"> 
                          <div class="img-order"><img src="assets/images/product/product02.png" alt="product image"></div>
                        </td>
                        <td class="order-name">American lobster</td>
                        <td class="order-price">$460.00</td>
                        <td class="order-quantity"> 
                          <input class="quantity no-round-input" type="number" min="1" value="1">
                        </td>
                        <td class="order-total">$460.00</td>
                      </tr>
                      <tr>
                        <td class="order-image"> 
                          <div class="img-order"><img src="assets/images/product/product05.png" alt="product image"></div>
                        </td>
                        <td class="order-name">Chrysanthemum</td>
                        <td class="order-price">$460.00</td>
                        <td class="order-quantity">
                          <input class="quantity no-round-input" type="number" min="1" value="2">
                        </td>
                        <td class="order-total">$920.00</td>
                      </tr>
                    </tbody>
                    <tr>
                      <td colspan="2"></td>
                      <td class="order-header" colspan="3">Tổng số tiền: 500 000vnd</td>
                    </tr>
                  </table>
                </div>
              </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div> 

@endsection