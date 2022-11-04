@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <a href="{{route('coupon.create')}}" class="btn btn-primary btn-lg" role="button" aria-disabled="true">
         <i class="material-icons">edit</i> Thêm Mã
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Danh sách sản phẩm</h4>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead class="text-warning">
              <th width="15%">Mã</th>
              <th width="25%">Tiêu đề</th>
              <th width="20%">Loại Giảm</th>
              <th width="10%">Mức Giảm</th>
              <th width="20%">Ngày Kết Thúc</th>
              <th width="5%"></th>
              <th width="5%"></th>
            </thead>
            <tbody>
              @foreach($coupon as $key => $value)
              <tr>
                <td><b>{{$value->Ma}}</b></td>
                <td>{{$value->TieuDe}}</td>
                <td>
                	@if($value->LoaiGiam==1)
                		Giảm theo phần trăm
                	@elseif($value->LoaiGiam==2)
                		Giảm theo tiền
                	@endif
                </td>
                <td>
                  <?php
                    if($value->LoaiGiam==1)
                      echo $value->MucGiam . '%';
                    elseif($value->LoaiGiam==2)
                      echo number_format($value->MucGiam , 0, ',', ' ');
                  ?>
                </td>
                <td>{{$value->NgayKetThuc}}</td>
                <td class="td-actions">
                  <a href="{{route('coupon.edit',$value->MaGG)}}" rel="tooltip" class="btn btn-info btn-link">
                    <i class="material-icons">edit</i>
                  </a>
                </td>
                <td class="td-actions ">
                  <form action="{{route('coupon.destroy',$value->MaGG)}}" method="post">
                    {{csrf_field() }}
                    @method('DELETE')
                    <button type="submit" rel="tooltip" class="btn btn-danger btn-link" onclick="return confirm('Bạn có chắc chắn muốn xoá')">
                      <i class="material-icons">delete</i>
                    </button>
                  </form>
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

@endsection
