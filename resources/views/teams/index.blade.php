@extends('layout')

@section('content')
<h1>Teams</h1>

<div class="section">
	<div class="row">{!! link_to_route('teams.create', 'Create Team', null, ['class' => 'button']) !!}</div>
</div>

<div class="section">
	@include ('teams.list')
</div>

@endsection
