@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
  <div class="row">
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-warning card-header-icon">
          <div class="card-icon">
            <i class="material-icons">person</i>
          </div>
          <p class="card-category">Số người đăng ký</p>
          <h3 class="card-title">{{$subscribers}}
          </h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">update</i> {{Carbon\Carbon::now()}}
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-success card-header-icon">
          <div class="card-icon">
            <i class="material-icons">store</i>
          </div>
          <p class="card-category">Doanh thu</p>
          <h3 class="card-title">{{number_format($statistical , 0, ',', ' ').'đ';}}</h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">date_range</i> {{Carbon\Carbon::now()}}
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-info card-header-icon">
          <div class="card-icon">
            <i class="material-icons">content_paste</i>
          </div>
          <p class="card-category">Số sản phẩm</p>
          <h3 class="card-title">{{$products}}</h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">update</i> Just Updated
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Sản Phẩm Bán Chạy</h4>
        </div>
        <div class="card-body">
          <form>
            @csrf
            <br>
            <div class="ct-chart" id="chart2"></div>
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
        url: '{{url('/product_bestsell')}}',
        method: "POST",
        dataType: 'JSON',
        data:{_token:_token},
        success:function(data){
          new Chartist.Bar('.ct-chart', {
            labels: data.labels,
            series: [data.series]
          },{
            fullWidth: true
          });
        }
      });
    }
  });
</script>

@endsection