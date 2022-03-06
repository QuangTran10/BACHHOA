@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <div class="card">
        <div class="card-header card-header-success">
          <h4 class="card-title">THAY ĐỔI MẬT KHẨU</h4>
        </div>
        <div class="card-body">
          <form id="ChangePassword">
            @csrf
            <div class="form-group">
              <label for="username" class="bmd-label-floating"> Email</label>
              <input type="email" class="form-control" id="email" required="true" name="Email">
            </div>
            <div class="form-group">
              <label for="password" class="bmd-label-floating"> Mật Khẩu Mới *</label>
              <input type="password" class="form-control" id="password" required="true" name="MatKhau">
            </div>
            <div class="form-group">
              <label for="password1" class="bmd-label-floating"> Nhập Lại Mật Khẩu *</label>
              <input type="password" class="form-control" id="password1" required="true" equalTo="#password" name="MatKhau1">
            </div>
            <button type="button" class="btn btn-success pull-right change_pass" name="Update">Đổi</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.change_pass').click(function(){
        var email = $('#email').val();
        var password = $('#password').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
          url: '{{url('/change_pass')}}',
          method: "POST",
          data:{
            Email:email,
            _token:_token,
            MatKhau: password},
            success:function(data){
              if(data==1){
                Swal.fire('Đổi mật khẩu thành công');
              }else{
                Swal.fire({
                  icon: 'error',
                  title: 'Tài khoản không phải của bạn',
                  text: 'Vui lòng thử lại'
                })
              }
            }
          });
      });
  });
</script>
@endsection
