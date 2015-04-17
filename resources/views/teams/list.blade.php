@if (count($teams) > 0)
	@foreach ($teams as $team)
		<div class="row">{!! link_to_route('teams.edit', $team->team_name, ['id' => $team->id]) !!}</div>
	@endforeach
	<div class="pagination">{!! $teams->render() !!}</div>
@else
	<div class="row">There are no teams</div>
@endif
