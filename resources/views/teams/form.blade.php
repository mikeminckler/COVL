@include ('feedback')

<div class="section form">
	@if (isset($team))
		{!! Form::model($team) !!}
	@else
		{!! Form::open() !!}
	@endif

	<div class="input-block">
                <div class="label">
			{!! Form::label('team_name', 'Team Name') !!}
		</div>
                <div class="input">
			{!! Form::text('team_name', null, ['class' => 'text-input']) !!}
                </div>
        </div>

	<div class="input-block">
		<div class="submit">
			@if (isset($team))	
				{!! Form::submit('Update Team') !!}
			@else
				{!! Form::submit('Create Team') !!}
			@endif
		</div>
	</div>

	{!! Form::close() !!}
</div>
