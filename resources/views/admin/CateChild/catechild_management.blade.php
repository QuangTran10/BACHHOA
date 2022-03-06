@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <a href="{{URL::to('/add_catechild')}}" class="btn btn-primary btn-lg" role="button" aria-disabled="true">
         <i class="material-icons">edit</i> Thêm Danh Mục
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Danh mục</h4>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead class="text-warning">
              <th>Tên Danh Mục</th>
              <th>Tên Danh Mục Con</th>
              <th>Thời Gian Cập Nhật</th>
              <th></th>
            </thead>
            <tbody>
              @foreach($all_category as $key => $value)
              <tr>
                <td>{{$value->TenLoai}}</td>
                <td>{{$value->TenDanhMuc}}</td>
                <td>{{$value->updated_at}}</td>
                <td>
                  <a href="{{URL::to('/update_catechild/'.$value->MaDM)}}"><i class="material-icons">edit</i></a>
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
