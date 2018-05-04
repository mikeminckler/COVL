<div class="game-set">
	@if (isset($game_set))
		{!! Form::hidden('game_score['.$game->id.']['.$set_number.'][game_set_id]', $game_set->id, ['class' => 'game-set-id']) !!}
	@endif

	@if (isset($ro))

		{!! Form::text('game_score['.$game->id.']['.$set_number.'][home_team]', $home_points, ['class' => 'game-set-score home-team ro', 'disabled' => 'disabled']) !!}
		-
		{!! Form::text('game_score['.$game->id.']['.$set_number.'][away_team]', $away_points, ['class' => 'game-set-score away-team ro', 'disabled' => 'disabled']) !!}
	@else
		<div class="remove-set"></div>
		{!! Form::text('game_score['.$game->id.']['.$set_number.'][home_team]', $home_points, ['class' => 'game-set-score home-team']) !!}
		-
		{!! Form::text('game_score['.$game->id.']['.$set_number.'][away_team]', $away_points, ['class' => 'game-set-score away-team']) !!}
	@endif
</div>
