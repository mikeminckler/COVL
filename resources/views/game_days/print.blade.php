@extends ('no_menus')

@section ('extra_css')
<link href="{{ asset('/css/print_stylesheet.css') }}" rel="stylesheet">
@endsection

@section ('content')

@if (count($game_day->games) > 0)

	<?php $court_count = 1 ?>
	@foreach ($game_day->season->leagues as $league)


		<h2>{{ $league->league_name }}</h2>

		@include ('game_days.rounds', ['hide_teams' => null, 'best_of' => 3])

		<div style="clear: both; page-break-after: always;"></div>

	@endforeach

@endif

@endsection
