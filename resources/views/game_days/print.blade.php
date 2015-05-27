@extends ('no_menus')

@section ('extra_css')
<link href="{{ asset('/css/print_stylesheet.css') }}" rel="stylesheet">
@endsection

@section ('content')

<div class="game-day-print">

	@if (count($game_day->games) > 0)

		<?php $court_count = 0 ?>
		@foreach ($game_day->season->leagues as $league)


			<h2>{{ $league->league_name }}</h2>

			@include ('game_days.rounds', ['hide_teams' => null, 'best_of' => 3])

			<div style="clear: both; page-break-after: always;"></div>

			<?php 
				$court_count += floor(count($game_day->teams($league)->get()) / 2);
			?>

		@endforeach

	@endif

</div>

@endsection
