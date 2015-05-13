@if (count($game_days) > 0)
	@foreach ($game_days as $game_day)
		<div class="row">
			<div class="column" data-column="1">{!! link_to_route('game-days.edit', $game_day->name, ['id' => $game_day->id]) !!}</div>
			<div class="column" data-column="2">{!! link_to_route('game-days.teams', 'Teams', ['id' => $game_day->id]) !!}</div>
			<div class="column" data-column="2">{!! link_to_route('game-days.games', 'Games', ['id' => $game_day->id]) !!}</div>
			<div class="column" data-column="2">{!! link_to_route('game-days.results', 'Results', ['id' => $game_day->id]) !!}</div>
			<div class="column" data-column="2">{!! link_to_route('game-days.print-schedule', 'Print Schedule', ['id' => $game_day->id], ['target' => '_blank']) !!}</div>
		</div>
	@endforeach
	<div class="pagination">{!! $game_days->render() !!}</div>
@else
	<div class="row">There are no Game Days</div>
@endif
