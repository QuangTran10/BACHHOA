<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h2>Hello</h2>
	@foreach($customer as $key => $value)
		<p>{{$value->MSKH}} {{$value->HoTenKH}}</p>
	@endforeach
	<br>
	@foreach($staff as $key => $value1)
		<p>{{$value1->MSNV}} {{$value1->HoTenNV}}</p>
	@endforeach
</body>
</html>