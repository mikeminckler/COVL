<div class="top-menu">
	{!! link_to_route('home', 'Home', null, ['class' => 'menu-item-top']) !!}
	{!! link_to_route('game-days', 'Game Days', null, ['class' => 'menu-item-top']) !!}
	{!! link_to_route('leagues', 'Leagues', null, ['class' => 'menu-item-top']) !!}
	{!! link_to_route('teams', 'Teams', null, ['class' => 'menu-item-top']) !!}
	{!! link_to_route('seasons', 'Seasons', null, ['class' => 'menu-item-top']) !!}
	{!! link_to('/auth/logout', 'Logout', null, ['class' => 'menu-item-top']) !!}
</div>
