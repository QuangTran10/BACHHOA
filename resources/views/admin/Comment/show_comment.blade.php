@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12"></div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Bình Luận Chưa Duyệt</h4>
        </div>
        <div class="card-body">
          <table class="table">
            <thead class="text-warning">
              <th width="20%"></th>
              <th width="30%"></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </thead>
            <tbody>
              @foreach($comment as $key => $value)
              <tr>
                <td>{{$value->Email}}</td>
                <td>{{$value->NoiDung}}</td>
                <td>{{Carbon\Carbon::parse($value->ThoiGian)->format('d/m/Y')}}</td>
                <td><img src="public/upload/{{$value->Image}}" width="100"></td>
                <td>{{$value->DanhGia}} <i class="material-icons" style="color: yellow">star</i></td>
                <td>
                  <form>
                    @csrf
                  </form>
                  @if($value->TrangThai==0)
                  <div class="togglebutton">
                    <label>
                      <input type="checkbox" class="toggle-status" data-id="{{$value->MaBinhLuan}}">
                      <span class="toggle"></span>
                    </label>
                  </div>
                  @elseif($value->TrangThai==1)
                  <div class="togglebutton">
                    <label>
                      <input type="checkbox" class="toggle-status" checked="" data-id="{{$value->MaBinhLuan}}">
                      <span class="toggle"></span>
                    </label>
                  </div>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div> {{-- end card body --}}
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('.toggle-status').change(function(event) {
      var id_comment = $(this).data('id');
      var is_checked = $(this).is(':checked');
      var _token = $('input[name="_token"]').val();
      var status;
      if(is_checked == true){
        status = 1;
      }else{
        status = 0;
      }

      $.ajax({
        url: '{{url('/status_comment')}}',
        method: "POST",
        data:{
          id_comment: id_comment,
          status: status,
          _token: _token },
          success:function(data){
            if(data=1){
              location.reload();
            }else if(data==0){
              Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Duyệt bình luận lỗi'
              })
            }
          }
        });
    });
  });
</script>

@endsection
