<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

use COVL\User;

class UsersTableSeeder extends Seeder {

	public function run()
	{

		$user = new User;
		$user->first_name = 'Mike';
		$user->last_name = 'Minckler';
		$user->email = 'mikeminckler@gmail.com';
		$user->password = bcrypt('u2agrav8');
		$user->save();

		$user = new User;
		$user->first_name = 'Dewi';
		$user->last_name = 'Griffiths';
		$user->email = 'dewi@brentwood.bc.ca';
		$user->password = bcrypt('u2agrav8');
		$user->save();

	}

}
