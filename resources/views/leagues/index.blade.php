@extends('layout')

@section('content')
<h1>Leagues</h1>

<div class="section">
	{!! link_to_route('leagues.create', 'Create League', null, ['class' => 'button']) !!}
</div>

<div class="section">
	@include ('leagues.list')
</div>

@endsection
