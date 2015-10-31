<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>iBookNow</title>

	<link href="{{ url('css/app.css') }}" rel="stylesheet">

	</head>
<body>
	@yield('content')

	<!-- Scripts -->
	<script src="{{ url('js/all.js') }}"></script>

	<!-- Custom Scripts -->
    @yield('script')

</body>
</html>
