@extends ('layout')

@section ('content')

<h1>{{ $season->season_name }} Game Days</h1>
<div class="section">
	<div class="row">{!! link_to_route('game-days.create', 'Create '.$season->season_name.' Game Days', ['season_id' => $season->id], ['class' => 'button']) !!}</div>
</div>

@if (count($season->gameDays) > 0)
	@include ('game_days.list', ['game_days' => $season->gameDays()->paginate(10)])
@else
	<div class="row">There are no Game Days</div>
@endif

@endsection
