<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('games', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('game_day_id');
			$table->integer('league_id');
			$table->integer('home_team_id');
			$table->integer('away_team_id');
			$table->integer('round');
			//$table->dateTime('start_time');

			$table->boolean('hidden');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('games');
	}

}
