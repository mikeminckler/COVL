<div class="game-set">
	<div class="remove-set"></div>
	@if (isset($game_set))
		{!! Form::hidden('game_score['.$game->id.']['.$set_number.'][game_set_id]', $game_set->id, ['class' => 'game-set-id']) !!}
	@endif
	{!! Form::text('game_score['.$game->id.']['.$set_number.'][home_team]', $home_points, ['class' => 'game-set-score']) !!}
	-
	{!! Form::text('game_score['.$game->id.']['.$set_number.'][away_team]', $away_points, ['class' => 'game-set-score']) !!}
</div>
