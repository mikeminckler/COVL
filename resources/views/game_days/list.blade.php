@if (count($game_days) > 0)
	@foreach ($game_days as $game_day)
		<div class="flex w-full">
			<div class="flex-1 px-2" data-column="1"><a href="{{ route('game-days.edit', ['id' => $game_day->id]) }}">{{ $game_day->name }}</a></div>
            <div class="grid grid-cols-4">
                <div class="px-2" data-column="2"><a href="{{ route('game-days.teams', ['id' => $game_day->id]) }}">Teams</a></div>
                <div class="px-2" data-column="2"><a href="{{ route('game-days.games', ['id' => $game_day->id]) }}">Games</a></div>
                <div class="px-2" data-column="2"><a href="{{ route('game-days.results', ['id' => $game_day->id]) }}">Results</a></div>
                <div class="px-2" data-column="2"><a href="{{ route('game-days.print-schedule', ['id' => $game_day->id]) }}" target="_blank"> <div class="icon"><i class="fas fa-print"></i></div></a></div>
            </div>
		</div>
	@endforeach
	<div class="mt-4">{!! $game_days->render() !!}</div>
@else
	<div class="row">There are no Game Days</div>
@endif
