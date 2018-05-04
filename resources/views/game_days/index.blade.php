@extends('layout')

@section('content')
<h1>Game Days</h1>

<div class="section">
	<div class="row">{!! link_to_route('game-days.create', 'Create Game Day', null, ['class' => 'button']) !!}</div>
</div>

<div class="section">
	@include ('game_days.list')
</div>

@endsection
