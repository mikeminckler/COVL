<div class="game" data-game-id="{{ $game->id }}">
	<div class="game-teams">
		@if ($game->away_team->id != 1 && !isset($ro) && !isset($hide_teams))
			<div class="add-set"></div>
		@endif
		<div class="team">
		<span class="seed">{{ $game_day->seed($game->home_team, $league) }}</span>
		@if (!isset($hide_teams))
			{{ $game->home_team->team_name }}
		@endif
		</div>
		<div class="team">
		<span class="versus">
		@if ($game->away_team->id == 1)
			@if (!isset($hide_teams))
				-
			@endif
		@else
			v 
		@endif
		</span>
		@if (!isset($hide_teams))
			{{ $game->away_team->team_name }}
		@endif
		@if ($game->away_team->id != 1)
			<span class="seed">{{ $game_day->seed($game->away_team, $league) }}</span>
		@endif
		</div>
	</div>

	<div class="game-sets">
		@if (count($game->gameSets) > 0)
			@foreach ($game->gameSets as $game_set)
				@include ('game_sets.display', ['set_number' => $game_set->number, 'home_points' => count($game_set->home_points), 'away_points' => count($game_set->away_points)])
			@endforeach
		@else
			@if (isset($best_of) && $game->home_team->id != 1 && $game->away_team->id != 1)

				@for ($g = 1; $g <= $best_of; $g++)
					<div class="game-set-blank">
						<div class="game-set-blank-home">&nbsp;</div>
						-
						<div class="game-set-blank-away">&nbsp;</div>
					</div>
				@endfor 

			@endif
		@endif
	</div>
</div>
