@extends ('layout')

@section ('content')

<h1>Teams for {{ $season->season_name }}</h1>

<div class="section form">
	@if (count($teams) > 0)
		{!! Form::open() !!}
		{!! Form::hidden('id', $season->id) !!}
			@foreach ($teams as $team)

				<div class="input-block">
					<div class="label">
						{!! Form::label($team->id, $team->team_name) !!}
					</div>
					<div class="input">
						@if ($season->teams->contains($team->id))
							{!! Form::checkbox('teams['.$team->id.']', null, true, ['id' => $team->id]) !!}
						@else
							{!! Form::checkbox('teams['.$team->id.']', null, null, ['id' => $team->id]) !!}
						@endif
					</div>
				</div>

			@endforeach

			<div class="input-block">
				<div class="submit">
					{!! Form::submit('Update Teams') !!}
				</div>
			</div>

		{!! Form::close() !!}
	@else
		<div class="row">There are no teams</div>
	@endif
</div>

@endsection
