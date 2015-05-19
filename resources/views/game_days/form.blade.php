@include ('feedback')

<div class="section form">
	@if (isset($game_day))
		{!! Form::model($game_day) !!}
	@else
		{!! Form::open() !!}
	@endif

	<div class="input-block">
		<div class="label">
			{!! Form::label('season_id', 'Season') !!}
		</div>
		<div class="input">
			@if (isset($season))
				{!! Form::text('season_id_search', $season->season_name, ['class' => 'text-input autocomplete', 'data-complete-url' => '/seasons/autocomplete-list']) !!}
				{!! Form::hidden('season_id', $season->id, ['class' => 'autocomplete-value']) !!}
			@else
				{!! Form::text('season_id_search', null, ['class' => 'text-input autocomplete', 'data-complete-url' => '/seasons/autocomplete-list']) !!}
				{!! Form::hidden('season_id', null, ['class' => 'autocomplete-value']) !!}
			@endif
		</div>
	</div>

	<div class="input-block">
                <div class="label">
			{!! Form::label('game_day_name', 'Game Day Name') !!}
		</div>
                <div class="input">
			{!! Form::text('game_day_name', null, ['class' => 'text-input']) !!}
                </div>
        </div>

	<div class="input-block">
                <div class="label">
			{!! Form::label('start_time', 'Start Date & Time') !!}
		</div>
                <div class="input">
			@if (isset($game_day))
				{!! Form::text('start_time', $game_day->start_time->format('Y-m-d H:i'), ['class' => 'text-input datetimepicker']) !!}
			@else
				{!! Form::text('start_time', null, ['class' => 'text-input datetimepicker']) !!}
			@endif
                </div>
        </div>

	<div class="input-block">
                <div class="label">
			{!! Form::label('end_time', 'End Time') !!}
		</div>
                <div class="input">
			@if (isset($game_day))
				{!! Form::text('end_time', $game_day->end_time->format('H:i'), ['class' => 'text-input timepicker']) !!}
			@else
				{!! Form::text('end_time', null, ['class' => 'text-input timepicker']) !!}
			@endif
                </div>
        </div>


	<div class="input-block">
                <div class="label">
                        {!! Form::label('exhibition', 'Is Exhibition') !!}
                </div>
                <div class="input">
                        @if (isset($game_day))
				@if ($game_day->exhibition)
					{!! Form::checkbox('exhibition', 'true', true) !!}
				@else
					{!! Form::checkbox('exhibition', 'true') !!}
				@endif
                        @else
				{!! Form::checkbox('exhibition', 'true') !!}
                        @endif
                </div>
        </div>


	<div class="input-block">
		<div class="submit">
			@if (isset($game_day))	
				{!! Form::submit('Update Game Day') !!}
			@else
				{!! Form::submit('Create Game Day') !!}
			@endif
		</div>
	</div>

	{!! Form::close() !!}
</div>
