@extends('welcome')
@section('contend') 

<div class="ogami-breadcrumb">
	<div class="container">
		<ul>
			<li> <a class="breadcrumb-link" href="{{URL::to('/home')}}"> <i class="fas fa-home"></i>Trang Chủ</a></li>
			<li> <a class="breadcrumb-link" href="{{URL::to('/cart_shopping')}}">Giỏ Hàng Của Bạn</a></li>
			<li> <a class="breadcrumb-link active" href="">Hoàn tất thanh toán</a></li>
		</ul>
	</div>
</div>
<div class="order-step">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="order-step_block">
					<div class="row no-gutters">
						<div class="col-12 col-md-4">
							<div class="step-block">
								<div class="step">
									<h2>Giỏ Hàng</h2><span>01</span>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="step-block">
								<div class="step">
									<h2>Thanh Toán</h2><span>02</span>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="step-block active">
								<div class="step">
									<h2>Hoàn Tất</h2><span>03</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End order step-->
<div class="order-complete">
	<div class="container">
		<div class="row">
			<div class="col-12 justify-content-center align-items-center text-center">
				<h1>Chúc mừng bạn đã <span>thanh toán </span>thành công</h1>
				<a href="{{URL::to('/home')}}" class="normal-btn"><i class="fas fa-home"></i> Trang Chủ</a>
			</div>
			<div class="col-12">
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
	</div>
</div>

@endsection