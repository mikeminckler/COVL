@extends ('layout')

@section ('content')

<h1> Results for {!! $game_day->linked_name !!}</h1>


<?php $court_count = 1 ?>
@foreach ($game_day->season->leagues as $league)
	<div class="section">

		<h2>{{ $league->league_name }}</h2>

		{!! $league->displayStandings($game_day, false) !!}

		@include ('game_days.rounds', ['ro' => true])

	</div>
@endforeach 

@endsection
