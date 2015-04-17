@extends ('layout')

@section ('content')

<h1> Results for {!! $game_day->linked_name !!}</h1>


@foreach ($game_day->season->leagues as $league)
	<div class="section">

		<h2>{{ $league->league_name }}</h2>

		{!! results($game_day->games($league)->get()) !!}

	</div>
@endforeach 

@endsection
