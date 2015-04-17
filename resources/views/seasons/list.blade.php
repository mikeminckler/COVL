@if (count($seasons) > 0)
	@foreach ($seasons as $season)
		<div class="row">
			<div class="column" data-column="1">{!! link_to_route('seasons.edit', $season->season_name, ['id' => $season->id]) !!}</div>
			<div class="column" data-column="2">{!! link_to_route('seasons.game-days', 'Game Days', ['id' => $season->id]) !!}</div>
			<div class="column" data-column="2">{!! link_to_route('seasons.leagues', 'Leagues', ['id' => $season->id]) !!}</div>
			<div class="column" data-column="2">{!! link_to_route('seasons.teams', 'Teams', ['id' => $season->id]) !!}</div>
		</div>
	@endforeach
	<div class="pagination">{!! $seasons->render() !!}</div>
@else
	<div class="row">There are no seasons</div>
@endif
