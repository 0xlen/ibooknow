<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>iBookNow</title>

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">
	<link href="{{ url('css/app.css') }}" rel="stylesheet">

	</head>
<body>

    <div class="container">
        <div class="row">
            <blockquote>
                <ul>
                    <li><b>iBookNow Beta (0.1.0b)</b></li>
                    <li>Author : Eason Cao</li>
                    <li>Email  : 0xlen [at] ntut.edu.tw</li>
                </ul>
            </blockquote>
        </div>

        <div class="row">
            @yield('content')
        </div>

        <span class="grey-text">iBookNow Beta &copy; {{ date('Y') }} Eason Cao, All rights reserved.</span>
    </div>

	<!-- Scripts -->
	<script src="{{ url('js/all.js') }}"></script>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>

	<!-- Custom Scripts -->
    @yield('script')

</body>
</html>
