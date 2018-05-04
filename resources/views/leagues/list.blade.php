@if (count($leagues) > 0)
	@foreach ($leagues as $league)
		<div class="row">
			<div class="column" data-column="1">{!! link_to_route('leagues.edit', $league->league_name, ['id' => $league->id]) !!}</div>
		</div>
	@endforeach
	<div class="pagination">{!! $leagues->render() !!}</div>
@else
	<div class="row">There are no leagues</div>
@endif
