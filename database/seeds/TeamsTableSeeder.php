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


	$teams = array(

		"Volley Ur Ballies",
		"Scared Hitless",
		"Kelsey Koalas",
		"Second Stringers",
		"Kelsey Breaker 9s",

		"Indiv II",
		"Ball Ox",
		"CSS Served Hot",
		"Setsations",
		"Stingers",

		"Playdate",
		"Off Courts",
		"Popup Blockers",
		"Sonic Boom",
		"I'd Hit That",

		"Itsy Bitsy Spiker",
		"Indiv I",
		"The Young and Resting",
		"Sets on the Beach",
		"Waller-Bs",

		"Unusual Suspects",
		"Old and Injured",
		"Tips Up",
		"A Touch of Grass",
		"Slade Jarbronis",

		"Canniballs",
		"BCS Shock",
		"Bumpin' Mugglies",
		"Ingram Pharmacy",
		"Wolfpack",

		"Man Hands",
		"Setting Ducks",
		"Quick 'n' Easy",
		"Alchobolics",
		"Dan 'n' Dannie"

	);

	foreach ($teams as $team_name) {
		$team = new Team;
		$team->team_name = $team_name;
		$team->save();

	}

    }

}
