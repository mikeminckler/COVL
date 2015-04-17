<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use COVL\Team;

class TeamsTableSeeder extends Seeder {

    public function run()
    {

	$team = new Team;
	$team->team_name = 'Bye';
	$team->save();


    }

}
