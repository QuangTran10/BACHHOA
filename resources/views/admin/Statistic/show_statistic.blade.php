@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8 col-md-8">
      <form>
        @csrf
      <div class="card ">
        <div class="card-header card-header-rose card-header-text">
          <div class="card-icon">
            <i class="material-icons">today</i>
          </div>
          <h4 class="card-title">Lọc Theo Tháng</h4>
        </div>
        <div class="card-body ">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="label-control">Ngày Bắt Đầu</label>
                <input type="text" class="form-control datetimepicker" id="Start_date">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="label-control">Ngày Kết Thúc</label>
                <input type="text" class="form-control datetimepicker" id="End_date">
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <button type="button" class="btn btn-fill btn-rose search_btn">Tìm Kiếm</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Doanh Thu</h4>
        </div>
        <div class="card-body table-responsive">
          <form>
            @csrf
            <div class="ct-chart ct-perfect-fourth" id="chart1"></div>
          </form>
        </div> {{-- end card body --}}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="ct-chart ct-perfect-fourth" id="chart2"></div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    setStatistic();

    function setStatistic(){
      var _token = $('input[name="_token"]').val();
      $.ajax({
        url: '{{url('/load_statistic')}}',
        method: "POST",
        dataType: 'JSON',
        data:{_token:_token},
        success:function(data){
          new Chartist.Line('#chart1', {
            labels: data.labels,
            series: [data.series]
          },{
            lineSmooth: Chartist.Interpolation.cardinal({
              fillHoles: true,
            })
          });
        }
      });
    }

    $('.search_btn').click(function() {
      var start_date =  $('#Start_date').val();
      var end_date = $('#End_date').val();
      var _token = $('input[name="_token"]').val();
      $.ajax({
        url: '{{url('/search_statistic')}}',
        method: "POST",
        dataType: 'JSON',
        data:{
          start_date: start_date,
          end_date:end_date,
          _token:_token
        },
        success:function(data){
          new Chartist.Line('#chart1', {
            labels: data.labels,
            series: [data.series]
          },{
            lineSmooth: Chartist.Interpolation.cardinal({
              fillHoles: true,
            })
          });
        }
      });
    });

    $(function () {
      $('.datetimepicker').datetimepicker({
        format:'YYYY-MM-DD HH:mm:ss'
      });
    });
  });
</script>

@endsection
