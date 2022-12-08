@extends('admin_layout')
@section('admin_content')

<div class="content">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card ">
						<div class="card-header card-header-success card-header-icon">
							<div class="card-icon">
								<i class="material-icons">inventory</i>
							</div>
							<h4 class="card-title">Khách hàng mua nhiều nhất</h4>
						</div>
						<div class="card-body ">
							<canvas id="myChart" width="400" height="200"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		var labels = {{ Js::from($labels) }};
		var series1 =  {{ Js::from($series1) }};
		var series2 =  {{ Js::from($series2) }};

		const ctx = $('#myChart');
		const data = {
			labels: labels,
			datasets: [
			{
				label: 'Số đơn hàng',
				data: series1,
				backgroundColor: '#FFFF00',
        		borderColor:'#e1fa02',
				borderWidth: 1,
				type: 'line',
				order: 0,
			},
			{
				label: 'Số tiền đã mua',
				data: series2,
				backgroundColor: '#9966FF',
				borderColor: '#9966FF',
				borderWidth: 1,
				order: 1,
			}]
		};
		const config = {
			type: 'bar',
			data: data,
			options: {
				interaction: {
					mode: 'index',
				},
				responsive: true,
				plugins: {
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Khách hàng mua nhiều nhất'
					}
				}
			}
		};
		const myChart = new Chart(ctx, config);
	});
</script>
@endsection