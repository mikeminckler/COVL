<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>COVL</title>

	<link href="{{ asset('/css/stylesheet.css') }}" rel="stylesheet">

	@if (!Auth::check())
		<link href="{{ asset('/css/external_stylesheet.css') }}" rel="stylesheet">
	@endif

	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

</head>
<body>

	<div id="container">

		@if (Auth::check())
			<div id="header">@include ('header')</div>
		@endif

		<div id="content">
			@yield('content')
		</div>

		@if (Auth::check())
			<div id="footer">@include ('footer')</div>
		@endif

	</div>

	<!-- Scripts -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
        <script src="{{ asset('/js/jquery.js') }}"></script>
        <script src="{{ asset('js/timepicker.js') }}"></script>
</body>
</html>
