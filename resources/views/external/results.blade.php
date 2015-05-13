@extends ('no_menus')

@section ('content')
@include ('results')
@endsection

@section ('extra_css')
	<link href="{{ asset('/css/external_stylesheet.css') }}" rel="stylesheet">
@endsection
