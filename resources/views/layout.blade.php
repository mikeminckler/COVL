@extends ('template')

@section ('body')
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
@endsection
