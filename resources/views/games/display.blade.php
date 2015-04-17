<div class="game" data-game-id="{{ $game->id }}">
	<div class="game-teams">
		@if ($game->away_team->id != 1)
			<div class="add-set"></div>
		@endif
		{{ $game->home_team->team_name }} 
		@if ($game->away_team->id == 1)
			-
		@else
			v 
		@endif
		{{ $game->away_team->team_name }}
	</div>

	<div class="game-sets">
		@foreach ($game->gameSets as $game_set)
			@include ('game_sets.display', ['set_number' => $game_set->number, 'home_points' => count($game_set->home_points), 'away_points' => count($game_set->away_points)])
		@endforeach
	</div>
</div>
