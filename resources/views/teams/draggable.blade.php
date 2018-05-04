<div class="teams-list">
	{!! Form::text('team_filter', null, ['class' => 'team-filter']) !!}
	@foreach ($teams as $team)
		@include ('teams.team_name', ['team' => $team])
	@endforeach
</div>
