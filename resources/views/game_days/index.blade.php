@extends('app')

@section('content')

<div class="flex items-baseline">
    <h1>Game Days</h1>
    <a class="flex mx-4" href="{{ route('game-days.create') }}">
        <div class="pr-1"><i class="fas fa-plus"></i></div>
        <div class="">Create Game Day</div>
    </a>
</div>

<div class="my-4">
	@include ('game_days.list')
</div>

@endsection
