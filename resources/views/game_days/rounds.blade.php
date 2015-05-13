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
						@include ('games.display', ['game' => $game, 'hide_teams' => $hide_teams, 'best_of' => $best_of])
					</div>
					<?php $row_count++ ?>
				@endforeach

			</div>
		@endfor
	</div>
@endif

