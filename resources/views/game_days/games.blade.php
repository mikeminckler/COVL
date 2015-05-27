@extends ('layout')

@section ('content')

<h1>Games for {!! $game_day->linked_name !!}</h1>

<div class="section">
	<div class="row">{!! link_to_route('game-days.schedule', 'Generate Schedule', ['id' => $game_day->id]) !!}</div>
</div>

@if (count($game_day->games) > 0)

	{!! Form::open() !!}

	<div class="section">
		<div class="input-block">
			<div class="submit">{!! Form::submit('Save Scores') !!}</div>
		</div>	
	</div>	

	<?php $court_count = 0 ?>
	@foreach ($game_day->season->leagues as $league)

		<h2>{{ $league->league_name }}</h2>

		@include ('game_days.rounds')

		<div style="clear: both"></div>

		<?php 
			$court_count += floor(count($game_day->teams($league)->get()) / 2);
		?>

	@endforeach

	<div class="input-block">
		<div class="submit">{!! Form::submit('Save Scores') !!}</div>
	</div>	
	{!! Form::close() !!}

@endif

@endsection
