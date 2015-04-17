<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UsersTableSeeder');
		$this->call('LeaguesTableSeeder');
		$this->call('SeasonsTableSeeder');
		$this->call('TeamsTableSeeder');

		if (env('APP_ENV') == 'development') {
			$this->call('DevSeeder');
		}

	}

}
