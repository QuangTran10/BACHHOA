@extends('welcome')
@section('contend') 

	<div class="ogami-breadcrumb">
        <div class="container">
          <ul>
            <li> <a class="breadcrumb-link" href="{{URL::to('/home')}}"> <i class="fas fa-home"></i>Trang Chủ</a></li>
            <li> <a class="breadcrumb-link active" href="{{URL::to('/contact_us')}}">Liên Hệ</a></li>
          </ul>
        </div>
      </div>
      <!-- End breadcrumb-->
      <div class="contact-us">
        <div class="container">
          <div class="contact-method">
            <div class="row">
              <div class="col-12 col-md-4">
                <div class="method-block"><i class="icon_pin_alt"></i>
                  <div class="method-block_text">
                    {{$contact_list->DiaChi}}
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="method-block"><i class="icon_mail_alt"></i>
                  <div class="method-block_text">
                    <p> <span>Điện Thoại: </span>{{$contact_list->SoDienThoai}}</p>
                    <p><span>Mail: </span>{{$contact_list->Email}}</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="method-block"><i class="icon_clock_alt"></i>
                  <div class="method-block_text">
                  	<?php
                  	$Open = Carbon\Carbon::createFromFormat('H:i:s', $contact_list->Open)->format('g:i A');
                  	$Close= Carbon\Carbon::createFromFormat('H:i:s', $contact_list->Close)->format('g:i A');
                  	?>
                    <p> <span>Ngày Trong Tuần:</span> {{$Open.' - '.$Close}}</p>
                    <p><span>Chủ Nhật:</span> Nghỉ</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- <div class="leave-message">
            <h1 class="title">Tư Vấn</h1>
            <p>Nhân viên của chúng tôi sẽ gọi lại và trả lời những câu hỏi của bạn.</p>
            <form action="" method="post">
              <div class="row">
                <div class="col-12 col-md-6">
                  <input class="no-round-input" type="text" placeholder="Name">
                </div>
                <div class="col-12 col-md-6">
                  <input class="no-round-input" type="email" placeholder="Email">
                </div>
                <div class="col-12">
                  <textarea class="textarea-form" name="" cols="30" rows="10" placeholder="Your message"></textarea>
                </div>
              </div>
            </form>
          </div> --}}
        </div>
    </div>

@endsection