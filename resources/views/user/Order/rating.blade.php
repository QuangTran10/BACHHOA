@extends('welcome')
@section('contend')

<div class="ogami-breadcrumb">
  <div class="container">
    <ul>
      <li> <a class="breadcrumb-link" href="{{URL::to('/home')}}"> <i class="fas fa-home"></i>Trang Chủ</a></li>
      <li> <a class="breadcrumb-link" href="{{URL::to('/show_order')}}">Đơn Hàng Của Tôi</a></li>
      <li> <a class="breadcrumb-link active">Đánh Giá Sản Phẩm</a></li>
    </ul>
  </div>
</div>

<div class="shopping-cart">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="product-table">
					<div class="order-history container">
						<div class="order-table">
							<table class="table"> 
								<colgroup>
									<col span="1" style="width: 20%">
									<col span="1" style="width: 35%">
									<col span="1" style="width: 15%">
									<col span="1" style="width: 10%">
									<col span="1" style="width: 30%">
								</colgroup>
								<tbody>
									{{-- Đơn hàng chưa đánh giá --}}
									@foreach($order_unrating as $k => $val)
									<tr>
										<td class="order-image"> 
											<div class="img-order"><img src="{{asset('public/upload/'.$val->Image)}}" alt="product image"></div>
										</td>
										<td class="order-name">
											<a href="{{URL::to('/product_details/'.$val->MSSP)}}">{{$val->TenSP}}</a>
										</td>
										<td class="order-price">
											{{number_format($val->GiaDatHang , 0, ',', ' ')}} đ
										</td>
										<td class="order-quantity"> 
											x {{$val->SoLuong}}
										</td>
										<td class="order-total">
											<button class="normal-btn rating-btn" data-id="{{$val->MSSP}}" data-image="{{asset('public/upload/'.$val->Image)}}" data-order_id="{{$val->MSDH}}">Đánh Giá</button>
										</td>
									</tr>
									@endforeach
									{{-- Đơn hàng đã đánh giá --}}
									@foreach($order_rating as $k => $val)
									
									<tr>
										<td class="order-image"> 
											<div class="img-order"><img src="{{asset('public/upload/'.$val->Image)}}" alt="product image"></div>
										</td>
										<td class="order-name">
											<a href="{{URL::to('/product_details/'.$val->MSSP)}}">{{$val->TenSP}}</a>
										</td>
										<td class="order-price">
											{{number_format($val->GiaDatHang , 0, ',', ' ')}} đ
										</td>
										<td class="order-quantity"> 
											x {{$val->SoLuong}}
										</td>
										<td class="order-total">
											{{-- <button class="normal-btn rating-btn" disabled data-id="{{$val->MSSP}}" data-image="{{asset('public/upload/'.$val->Image)}}" data-order_id="{{$val->MSDH}}">Đánh Giá</button> --}}
											Đã đánh giá
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="rating" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="card-body text-center">
				<img src="" id="rating_image" height="100" width="120">
				<div class="comment-box text-center">
					<h4>Thêm Đánh Giá</h4>
					<form>
						@csrf
						<input type="hidden" name="MSSP" id="rating_MSSP">
						<input type="hidden" name="MSDH" id="rating_MSDH">
						<div class="rating">
							<input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
							<input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
							<input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
							<input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
							<input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
						</div>
						<div class="comment-area">
							<textarea class="form-control" id="rating_content" name="NoiDung" placeholder="Đánh giá của bạn" rows="4"></textarea>
						</div>
					</form>
					<div class="text-center mt-4">
						<button class="btn btn-success send send-rating px-5">Gửi<i class="fa fa-long-arrow-right ml-1"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection