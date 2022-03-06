@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Hình ảnh sản phẩm</h4>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead class="text-warning">
              <th width="15%">Mã Số</th>
              <th width="40%">Tên Sản Phẩm</th>
              <th width="40%">Hình Ảnh</th>
              <th width="5%"></th>
            </thead>
            @foreach($images as $key => $value)
            <tr>
              <td>{{$value->MSSP}}</td>
              <td>{{$value->TenSP}}</td>
              <td><img src="public/upload/{{$value->HinhAnh}}" width="40%"></td>
              <td>
                <a href="{{URL::to('/delete_images/'.$value->ID)}}" onclick="return confirm('Bạn có chắc chắn muốn xoá')" type="button" rel="tooltip" class="btn btn-danger btn-round">
                    <i class="material-icons">close</i>
                </a>
              </td>
            </tr>
            @endforeach
          </table>
          <div style="text-align: center;">
            {{$images->links()}}
          </div>    
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-2 col-md-2">
      <a href="{{URL::to('/product_management')}}" class="btn btn-success btn-lg" role="button" aria-disabled="true">
         Trở về
      </a>
    </div>
  </div>
</div>

@endsection
