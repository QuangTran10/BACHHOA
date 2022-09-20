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
</body>
</html>