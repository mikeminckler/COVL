@include ('feedback')

<div class="section form">
	@if (isset($league))
		{!! Form::model($league) !!}
	@else
		{!! Form::open() !!}
	@endif

	<div class="input-block">
                <div class="label">
			{!! Form::label('league_name', 'League Name') !!}
		</div>
                <div class="input">
			{!! Form::text('league_name', null, ['class' => 'text-input']) !!}
                </div>
        </div>

	<div class="input-block">
                <div class="label">
			{!! Form::label('minimum_points', 'Minimum Points') !!}
		</div>
                <div class="input">
			{!! Form::text('minimum_points', null, ['class' => 'text-input']) !!}
                </div>
        </div>



	<div class="input-block">
		<div class="submit">
			@if (isset($league))	
				{!! Form::submit('Update League') !!}
			@else
				{!! Form::submit('Create League') !!}
			@endif
		</div>
	</div>

	{!! Form::close() !!}
</div>
