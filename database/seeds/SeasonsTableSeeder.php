<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

use COVL\Season;

class SeasonsTableSeeder extends Seeder {

    public function run()
    {
	$season = new Season;
	$season->season_name = 'COVL 2015';
	$season->start_date = '2015-04-29 00:00:00';
	$season->end_date = '2015-07-08 00:00:00';
	$season->save();
    }

}
