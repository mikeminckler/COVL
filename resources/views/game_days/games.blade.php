@extends ('layout')

@section ('content')

<h1>Games for {!! $game_day->linked_name !!}</h1>

<div class="section">
	<div class="row">{!! link_to_route('game-days.schedule', 'Generate Schedule', ['id' => $game_day->id]) !!}</div>
</div>

@if (count($game_day->games) > 0)

	{!! Form::open() !!}

	<div class="section">
		<div class="input-block">
			<div class="submit">{!! Form::submit('Save Scores') !!}</div>
		</div>	
	</div>	

	<?php $court_count = 1 ?>
	@foreach ($game_day->season->leagues as $league)




			
			<div class="section">
				<div class="right">
					<div class="row">{{ $league->league_name }} Standings</div>
					{!! results($game_day->games($league)->get()) !!}
				</div>
			</div>

			<h2>{{ $league->league_name }}</h2>

			@if ($game_day->rounds($league) > 0)

			<div class="section">


				<div class="row">

					@for ($i = 0; $i <= count($game_day->games($league, $i)->get()); $i++)
						@if ($i > 0)

							@if ($i == count($game_day->games($league, $i)->get()) && COVL\GameDay::hasBye($game_day->games($league)->get()))
								<div class="column" data-column="{{ $i + 1 }}">BYE</div>
							@else
								<div class="column court-name" data-column="{{ $i + 1 }}">Court {{ $court_count }}</div>
								<?php $court_count++ ?>
							@endif
						@else
							<div class="column" data-column="{{ $i + 1 }}">&nbsp;</div>
						@endif
					@endfor
				</div>


				@for ($i = 1; $i <= $game_day->rounds($league); $i++)

					<div class="round row">
						<div class="column" data-column="1">{!! $game_day->roundStartTime($league, $i) !!}</div>

						<?php $row_count = 2 ?>

						@foreach ($game_day->games($league, $i)->get() as $game)
							<div class="column" data-column="{{ $row_count }}">
								@include ('games.display', ['game' => $game])
							</div>
							<?php $row_count++ ?>
						@endforeach

					</div>
				@endfor
			@endif

		</div>
	@endforeach

	<div class="input-block">
		<div class="submit">{!! Form::submit('Save Scores') !!}</div>
	</div>	
	{!! Form::close() !!}

@endif

@endsection
