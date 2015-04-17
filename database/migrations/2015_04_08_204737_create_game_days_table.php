<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameDaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('game_days', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('game_day_name');
			$table->dateTime('start_time');
			$table->dateTime('end_time');
			$table->integer('season_id');

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
		Schema::drop('game_days');
	}

}
