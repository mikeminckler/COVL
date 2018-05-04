@include ('feedback')

<div class="section form">
	@if (isset($season))
		{!! Form::model($season) !!}
	@else
		{!! Form::open() !!}
	@endif

	<div class="input-block">
                <div class="label">
			{!! Form::label('season_name', 'Season Name') !!}
		</div>
                <div class="input">
			{!! Form::text('season_name', null, ['class' => 'text-input']) !!}
                </div>
        </div>

	<div class="input-block">
                <div class="label">
			{!! Form::label('start_date', 'Start Date') !!}
		</div>
                <div class="input">
			{!! Form::text('start_date', null, ['class' => 'text-input datepicker']) !!}
                </div>
        </div>


	<div class="input-block">
                <div class="label">
			{!! Form::label('end_date', 'End Date') !!}
		</div>
                <div class="input">
			{!! Form::text('end_date', null, ['class' => 'text-input datepicker']) !!}
                </div>
        </div>



	<div class="input-block">
		<div class="submit">
			@if (isset($season))	
				{!! Form::submit('Update Season') !!}
			@else
				{!! Form::submit('Create Season') !!}
			@endif
		</div>
	</div>

	{!! Form::close() !!}
</div>
