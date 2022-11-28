@extends('welcome')
@section('contend') 

<div class="ogami-breadcrumb">
	<div class="container">
		<ul>
			<li> <a class="breadcrumb-link" href="{{URL::to('/home')}}"> <i class="fas fa-home"></i>Trang Chủ</a></li>
			<li> <a class="breadcrumb-link active" href="{{URL::to('/about_us')}}">Giới Thiệu</a></li>
		</ul>
	</div>
</div>
<!-- End breadcrumb-->
<div class="about-us">
	<div class="container">
		<div class="our-story">
			<div class="row">
				<div class="col-12 col-md-6">
					<div class="our-story_text">
						<h1 class="title green-underline">CÂU CHUYỆN CỦA CHÚNG TÔI</h1>
						<p style="text-align: justify;">Chúng tôi mong muốn mang đến sự nhanh chóng và tiện lợi tối đa khi mua sắm đến cho khách hàng bằng việc đưa hệ thống siêu thị BEE STORE phủ rộng khắp mọi khu vực kể cả vùng nông thôn. Bên cạnh đó, chúng tôi cũng tập trung phát triển kênh mua sắm online trên website BEE STORE để phục vụ cho mọi đối tượng, đặc biệt là nhóm khách hàng trẻ.
						BEE STORE cũng không ngừng tìm kiếm và mang đến sự đa dạng trong việc lựa chọn sản phẩm với hơn 12.000 sản phẩm đủ chủng loại, xuất xứ rõ ràng, giá cả hợp lý, minh bạch.</p>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="our-story_video"><img src="{{('public/frontend/assets/images/poster/tree-logo.png')}}"></div>
				</div>
			</div>
		</div>
		<div class="our-number">
			<div class="row">
				<div class="col-md-4">
					<div class="our-number_block">
						<div class="our-number_icon"><img src="{{('public/frontend/assets/images/pages/about_us_icon_1.png')}}" alt="icon"></div>
						<div class="our-number_info">
							<h1 class="nummber-increase"><span class="numscroller" data-min="1" data-max="100" data-delay="5" data-increment="10">100</span>%</h1>
							<p>Múc Độ Hài Lòng</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="our-number_block">
						<div class="our-number_icon"><img src="{{('public/frontend/assets/images/pages/about_us_icon_2.png')}}" alt="icon"></div>
						<div class="our-number_info">
							<h1 class="nummber-increase"><span class="numscroller" data-min="1" data-max="{{$subscribers}}" data-delay="2" data-increment="10"></span></h1>
							<p>Nhân Viên</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="our-number_block">
						<div class="our-number_icon"><img src="{{('public/frontend/assets/images/pages/about_us_icon_3.png')}}" alt="icon"></div>
						<div class="our-number_info">
							<h1 class="nummber-increase">+<span class="numscroller" data-min="1" data-max="{{$products}}" data-delay="5" data-increment="10">16</span></h1>
							<p>Sản Phẩm</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- <div class="full-fluid">
		<div class="why-choose-us">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-sm-8 col-md-4 align-self-end">
						<div class="wcu_img"><img src="{{('public/frontend/assets/images/pages/wcu_img.png')}}" alt="image"></div>
					</div>
					<div class="col-sm-10 col-md-8">
						<div class="wcu-wrapper">
							<div class="row">
								<div class="col-12">
									<h1 class="title green-underline">Why Choose Us</h1>
								</div>
								<div class="col-12">
									<div class="row">
										<div class="col-lg-6">
											<div class="wcu-block">
												<div class="wcu_icon">
													<div class="icon-detail"><img src="{{('public/frontend/assets/images/homepage01/dow_icon_1.png')}}" alt=""></div>
												</div>
												<div class="wcu_intro">
													<h5>Eat Healthier</h5>
													<p>Modi tempora incidunt ut labore dolore magnam aliquam</p>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="wcu-block">
												<div class="wcu_icon">
													<div class="icon-detail"><img src="{{('public/frontend/assets/images/homepage01/dow_icon_2.png')}}" alt=""></div>
												</div>
												<div class="wcu_intro">
													<h5>We Have Brands</h5>
													<p>Modi tempora incidunt ut labore dolore magnam aliquam</p>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="wcu-block">
												<div class="wcu_icon">
													<div class="icon-detail"><img src="{{('public/frontend/assets/images/homepage01/dow_icon_3.png')}}" alt=""></div>
												</div>
												<div class="wcu_intro">
													<h5>Fresh And Clean Products</h5>
													<p>Modi tempora incidunt ut labore dolore magnam aliquam</p>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="wcu-block">
												<div class="wcu_icon">
													<div class="icon-detail"><img src="{{('public/frontend/assets/images/homepage01/dow_icon_4.png')}}" alt=""></div>
												</div>
												<div class="wcu_intro">
													<h5>Modern Process</h5>
													<p>Modi tempora incidunt ut labore dolore magnam aliquam</p>
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
	</div> --}}
</div>
<!-- End about us-->

@endsection