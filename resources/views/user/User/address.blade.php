@extends('welcome')
@section('contend') 

<div class="ogami-breadcrumb">
	<div class="container">
		<ul>
			<li> <a class="breadcrumb-link" href="{{URL::to('/home')}}"> <i class="fas fa-home"></i>Trang Chủ</a></li>
			<li> <a class="breadcrumb-link" href="{{URL::to('/my_account')}}">Tài khoản</a></li>
		</ul>
	</div>
</div>

<div class="blog-layout">
  <div class="container">
    <div class="row">
      <div class="col-xl-3">
        <div class="blog-sidebar">
          <button class="no-round-btn" id="filter-sidebar--closebtn">Close sidebar</button>
          <div class="blog-sidebar_search">

          </div>
          <div class="blog-sidebar_categories">
            <div class="categories_top mini-tab-title underline">
              <h2 class="title">Tài Khoản Của Tôi</h2>
            </div>
            <div class="categories_bottom">
              <ul>
                <li><a class="category-link" href="{{URL::to('/my_account')}}">Hồ Sơ</a></li>
                <li> <a class="category-link active" href="{{URL::to('/show_address')}}">Địa Chỉ Giao Hàng</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-xl-9">
        <div class="blog-grid_1col">
          <div id="show-filter-sidebar">
            <h5> <i class="fas fa-bars"></i></h5>
          </div>
          <div class="row">
            <div class="col-12">
              <form>
                {{csrf_field() }}
              @foreach($address_ship as $value)
              <div class="blog-block">
                <div class="blog-text">
                  <div class="blog-credit">
                    <p class="credit date">{{$value->HoTen}}</p>
                    <p class="credit comment">{{$value->SDT}}</p>
                  </div>
                  <p class="blog-describe">
                    {{$value->DiaChi}}
                  </p>
                  <a class="blog-readmore update_address" data-id="{{$value->MaDC}}" href=""><i class="far fa-edit"></i><span> <i class="arrow_carrot-2right"></i></span></a>
                </div>
              </div>
              @endforeach
              </form>
            </div>
            <button class="no-round-btn add_address">Thêm Địa Chỉ</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection