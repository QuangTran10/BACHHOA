@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <button class="btn btn-primary btn-lg" role="button" aria-disabled="true" data-toggle="modal" data-target="#add_producer">
         <i class="material-icons">edit</i> Thêm
      </button>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Danh sách NSX</h4>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead class="text-warning">
              <th width="10%">Mã</th>
              <th width="15%">Tên</th>
              <th width="20%">Email</th>
              <th width="30%">Địa Chỉ</th>
              <th width="15%">Số Điện Thoại</th>
              <th width="5%"></th>
              <th width="5%"></th>
            </thead>
            <tbody>
              @foreach($producer as $key => $value)
              <tr>
                <td><b>{{$value->MaNSX}}</b></td>
                <td>{{$value->Ten}}</td>
                <td>{{$value->Email}}</td>
                <td>{{$value->DiaChi}}</td>
                <td>{{$value->SDT}}</td>
                <td class="td-actions">
                  <a href="{{route('producer.edit',$value->MaNSX)}}" rel="tooltip" class="btn btn-info btn-link">
                    <i class="material-icons">edit</i>
                  </a>
                </td>
                <td class="td-actions ">
                  {{-- <form action="{{route('coupon.destroy',$value->MaGG)}}" method="post">
                    {{csrf_field() }}
                    @method('DELETE')
                    <button type="submit" rel="tooltip" class="btn btn-danger btn-link" onclick="return confirm('Bạn có chắc chắn muốn xoá')">
                      <i class="material-icons">delete</i>
                    </button>
                  </form> --}}
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

<div class="modal fade" id="add_producer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Thêm Nhà Sản Xuất</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
      </div>
      <form method="post" class="form-horizontal" id="add_coupon">
        {{csrf_field() }}
        <div class="modal-body">
          <div class="row">
            <label class="col-sm-3 col-form-label">Tên NSX</label>
            <div class="col-sm-9">
              <div class="form-group">
                <input type="text" class="form-control" name="Ten" required>
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <div class="form-group">
                <input type="email" class="form-control" name="Email" required >
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-3 col-form-label">Địa Chỉ</label>
            <div class="col-sm-9">
              <div class="form-group">
                <input type="text" class="form-control" name="DiaChi" required>
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-3 col-form-label">Số Điện Thoại</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="SDT" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-link">Thêm</button>
          <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>


@endsection
