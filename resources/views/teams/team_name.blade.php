<div class="team-name" data-team-name="{{ $team->team_name }}">
	{{ $team->team_name }} 
	<div class="remove-team"></div>
	@if (isset($league))
		{!! Form::hidden('league_teams['.$league->id.']['.$team->id.']', $team->id, ['class' => 'team-value']) !!}
	@else
		{!! Form::hidden(null, $team->id, ['class' => 'team-value']) !!}
	@endif
</div>
