@extends('admin_layout')
@section('admin_content')}

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Danh sách đơn hàng</h4>
        </div>
        <div class="card-body table-responsive" id="table-order">
          <table class="table table-hover">
            <thead class="text-dark">
              <th width="15%">Mã nhân viên</th>
              <th width="25%">Họ tên</th>
              <th width="20%">Email</th>
              <th width="10%" style="text-align: center;">Admin</th>
              <th width="10%" style="text-align: center;">Staff</th>
              <th width="10%" style="text-align: center;">Stock</th>
              <th style="text-align: center;" width="10%"></th>
            </thead>
            <tbody>
              @foreach($roles as $key => $value)
              <form>
                {{csrf_field() }}
              <tr>
                <td>{{$value->MSNV}}</td>
                <td>{{$value->HoTenNV}}</td>
                <td>{{$value->Email}}</td>
                <td class="text-center">
                	<div class="form-check">
                		<label class="form-check-label">
                			<input class="form-check-input" id="role_admin_{{$value->MSNV}}" type="checkbox" value="" {{$value->hasRole('admin') ? 'checked' : ''}}>
                			<span class="form-check-sign">
                				<span class="check"></span>
                			</span>
                		</label>
                	</div>
                </td>
                <td class="text-center">
                	<div class="form-check">
                		<label class="form-check-label">
                			<input class="form-check-input" id="role_staff_{{$value->MSNV}}" type="checkbox" value="" {{$value->hasRole('staff') ? 'checked' : ''}}>
                			<span class="form-check-sign">
                				<span class="check"></span>
                			</span>
                		</label>
                	</div>
                </td>
                <td class="text-center">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" id="role_stock_{{$value->MSNV}}" type="checkbox" value="" {{$value->hasRole('stock') ? 'checked' : ''}}>
                      <span class="form-check-sign">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                </td>
                <td class="td-actions text-center">
                  <button type="button" rel="tooltip" class="btn btn-info btn-save" data-id="{{$value->MSNV}}">
                    <i class="material-icons">save</i>
                  </button>
                </td>
              </tr>
              </form>
              @endforeach
            </tbody>
          </table>
        </div> {{-- end card body --}}
      </div>
    </div>
  </div>
</div>

@endsection