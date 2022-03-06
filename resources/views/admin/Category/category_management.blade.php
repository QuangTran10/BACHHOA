@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <a href="{{URL::to('/add_category')}}" class="btn btn-primary btn-lg" role="button" aria-disabled="true">
         <i class="material-icons">edit</i> Thêm Danh Mục
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Danh sách danh mục</h4>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead class="text-warning">
              <th>Mã Danh Mục</th>
              <th>Tên Danh Mục</th>
              <th style="text-align: center;">Tình Trạng</th>
              <th>Thời Gian Cập Nhật</th>
              <th></th>
              <th></th>
            </thead>
            <tbody>
              @foreach($all_category as $key => $value)
              <tr>
                <td>{{$value->MaLoai}}</td>
                <td>{{$value->TenLoai}}</td>
                <td style="text-align: center;">
                  <?php
                    if($value->TrangThai ==1)
                      echo '<i class="material-icons">done</i>';
                    else  
                      echo '<i class="material-icons">clear</i>';
                  ?>
                </td>
                <td>{{$value->created_at}}</td>
                <td>
                  <a href="{{URL::to('/update_category/'.$value->MaLoai)}}"><i class="material-icons">edit</i></a>
                </td>
                <td>
                  <a href="{{URL::to('/delete_category/'.$value->MaLoai)}}" onclick="return confirm('Bạn có chắc chắn muốn xoá')">
                    <i class="material-icons">delete</i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{$all_category->links()}}
          {{-- <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              <li class="page-item disabled">
                <a class="page-link" href="javascript:;" tabindex="-1">Previous</a>
              </li>
              <li class="page-item"><a class="page-link" href="javascript:;"></a></li>
              <li class="page-item">
                <a class="page-link" href="javascript:;">Next</a>
              </li>
            </ul>
          </nav> --}}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
