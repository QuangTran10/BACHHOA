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
                              <li><a class="category-link active" href="{{URL::to('/my_account')}}">Hồ Sơ</a></li>
                              <li> <a class="category-link" href="{{URL::to('/show_address')}}">Địa Chỉ Giao Hàng</a></li>
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
                            <div class="account">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 col-md-10 mx-auto">
                                            <h1 class="title">HỒ SƠ CỦA TÔI</h1>

                                            <form action="{{URL::to('/change_info')}}" method="post" id="Register" enctype="multipart/form-data">
                                            <div class="user-profilesinglepage" id="avatar-header">
                                                <div class="avatar-header">
                                                    <div class="avatar-wrapper">
                                                        <img class="profile-pic" src="{{asset('public/frontend/assets/images/Avatar/'.$user_infor->Avatar)}}"/>
                                                        <div class="upload-button">
                                                            <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                                        </div>
                                                        <input class="file-upload" type="file" name="Avatar" accept="image/*" id="Avatar" />
                                                    </div>
                                                    <div class="nametitle text-center">
                                                        <h4>{{$user_infor->HoTenKH}}</h4>
                                                        <h5>
                                                            <?php
                                                            $birthday = Carbon\Carbon::parse($user_infor->NgaySinh)->format('d/m/Y');
                                                            echo $birthday;
                                                            ?>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div> 

                                            
                                                {{csrf_field() }}
                                                <label for="HoTenKH">Họ Tên</label>
                                                <input class="no-round-input" id="HoTenKH" type="text" name="HoTenKH" value="{{$user_infor->HoTenKH}}">
                                                <label for="sex">Giới Tính</label>
                                                <input  name="GioiTinh" type="radio" value="0" {{ ($user_infor->GioiTinh=='0')? "checked" : ""}}> Nam
                                                <input name="GioiTinh" type="radio" value="1" {{ ($user_infor->GioiTinh=='1')? "checked" : ""}}> Nữ
                                                <input name="GioiTinh" type="radio" value="2" {{ ($user_infor->GioiTinh=='2')? "checked" : ""}}> Khác
                                                <label for="birthday">Ngày Sinh</label>
                                                <input class="no-round-input" id="NgaySinh" name="NgaySinh" type="date" value="{{$user_infor->NgaySinh}}">
                                                <label for="SDT">Số Điện Thoại</label>
                                                <input class="no-round-input" id="SDT" name="SDT" type="text" value="{{$user_infor->SDT}}">
                                                <label for="Email">Email</label>
                                                <input class="no-round-input" id="Email" name="Email" type="email" value="{{$user_infor->Email}}" readonly="">
                                                <div class="account-function">
                                                  <button class="no-round-btn" type="submit" name="DangKi">Cập Nhật</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection