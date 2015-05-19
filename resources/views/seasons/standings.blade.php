@extends ('layout')

@section ('content')

<h1>Standings for {{ $season->season_name }}</h1>

@foreach ($season->leagues as $league)
	
	<h2>{{ $league->league_name }}</h2>
	<div class="section">

		{!! $league->displayStandings($league->gameDays($season)->where('exhibition', false)->get()) !!}

	</div>

@endforeach

@endsection
