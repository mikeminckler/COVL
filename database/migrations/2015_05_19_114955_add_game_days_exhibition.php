<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGameDaysExhibition extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('game_days', function(Blueprint $table)
		{
			$table->boolean('exhibition');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('game_days', function(Blueprint $table)
		{
			$table->dropColumn('exhibition');
		});
	}

}
