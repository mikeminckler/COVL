<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

use COVL\League;

class LeaguesTableSeeder extends Seeder {

    public function run()
    {
	$leagues = array(
		'Elite',
		'El-Compo',
		'Competitive',
		'Inter-Comp',
		'Intermediate',
		'Inter-Rec',
		'Recreational'
	);

	foreach ($leagues as $league) {
		$l = new League;
		$l->league_name = $league;
		$l->save();
	}

    }

}
