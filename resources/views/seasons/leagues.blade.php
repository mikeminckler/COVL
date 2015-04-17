@extends ('layout')

@section ('content')

<h1>Leagues for {{ $season->season_name }}</h1>

<div class="section form">
	@if (count($leagues) > 0)
		{!! Form::open() !!}
		{!! Form::hidden('id', $season->id) !!}
			@foreach ($leagues as $league)

				<div class="input-block">
					<div class="label">
						{!! Form::label($league->id, $league->league_name) !!}
					</div>
					<div class="input">
						@if ($season->leagues->contains($league->id))
							{!! Form::checkbox('leagues['.$league->id.']', null, true, ['id' => $league->id]) !!}
						@else
							{!! Form::checkbox('leagues['.$league->id.']', null, null, ['id' => $league->id]) !!}
						@endif
					</div>
				</div>

			@endforeach

			<div class="input-block">
				<div class="submit">
					{!! Form::submit('Update Leagues') !!}
				</div>
			</div>

		{!! Form::close() !!}
	@else
		<div class="row">There are no leagues</div>
	@endif
</div>

@endsection
