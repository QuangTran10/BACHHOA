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
          <form id="form-chart">
            @csrf
            {{-- <div class="ct-chart ct-perfect-fourth" id="chart1"></div> --}}
            <canvas id="myChart" width="400" height="400"></canvas>
          </form>
        </div> {{-- end card body --}}
      </div>
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
          const ctx = $('#myChart');
          const myChart = new Chart(ctx, {
            type: 'line',
            data: {
              labels: data.labels,
              datasets: [{
                label: 'Số đơn hàng',
                data: data.series,
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });
        }
      });
    }

    $('.search_btn').click(function() {
      var start_date =  $('#Start_date').val();
      var end_date = $('#End_date').val();
      var _token = $('input[name="_token"]').val();
      if(end_date < start_date){
        Swal.fire(
          'Cảnh Báo!',
          'Vui lòng chọn ngày kết thúc lớn hơn ngày bắt đầu',
          'error'
          )
      }else{
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
            $('#myChart').remove();
            $('#form-chart').append('<canvas id="myChart" width="400" height="400"></canvas>');
            const ctx = $('#myChart');
            const myChart = new Chart(ctx, {
              type: 'line',
              data: {
                labels: data.labels,
                datasets: [{
                  label: 'Số đơn hàng',
                  data: data.series,
                  backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
                  ],
                  borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
                  ],
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
          }
        });
      }
      

    });

    $(function () {
      $('.datetimepicker').datetimepicker({
        format:'YYYY-MM-DD HH:mm:ss'
      });
    });
  });
</script>

@endsection
