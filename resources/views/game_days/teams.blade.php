@extends ('layout')

@section ('content')

<h1>{!! $game_day->linked_name !!}</h1>

@include ('teams.draggable', ['teams' => $game_day->unUsedTeams()])

@if (count($game_day->season->leagues) > 0)
	{!! Form::open() !!}
	<div class="section"><div class="input-block"><div class="submit">{!! Form::submit('Save Teams') !!}</div></div></div>
		@foreach ($game_day->season->leagues as $league)
			<div class="section">
				<h2>{{ $league->league_name }}</h2>
				<div class="row">
					<div class="populate button" data-season-id="{{ $game_day->season->id }}" data-league-id="{{ $league->id }}">Top 5</div>
				</div>
				<div class="league-teams" data-league-id="{{ $league->id }}">
					@if (count($game_day->teams($league)->get()) > 0)
						<?php $count = 1; ?>
						@foreach ($game_day->teams($league)->get() as $team)
							@include ('teams.team_name', ['team' => $team, 'league' => $league, 'count' => $count])
							<?php $count++ ?>
						@endforeach
					@endif
				</div>
			</div>
		@endforeach
	<div class="section"><div class="input-block"><div class="submit">{!! Form::submit('Save Teams') !!}</div></div></div>
	{!! Form::close() !!}

@else
	<div class="row">There are no leagues for this season</div>
@endif


@endsection
