@extends('layout')

@section('content')
<h1>Seasons</h1>

<div class="section">
	{!! link_to_route('seasons.create', 'Create Season', null, ['class' => 'button']) !!}
</div>

<div class="section">
	@include ('seasons.list')
</div>

@endsection
