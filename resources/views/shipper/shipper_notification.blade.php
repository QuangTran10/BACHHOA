@extends('shipper_layout')

@section('shipper_header')

<div class="navbar">
	<div class="container">
		<div class="row">
			<div class="col s9">
				<div class="content-left">
					<a href="{{URL::to('/dashboard_shipper')}}"><h1><span>E</span>xpress</h1></a>
				</div>
			</div>
			<div class="col s3">
				<div class="content-right">
					<a href="#slide-out" data-activates="slide-out" class="sidebar"><i class="fa fa-bars"></i></a>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('shipper_content')



@endsection