<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model {


	public function store($input, $id = null) {

		if ($id) {
			$team = $this->find($id);
		} else {
			$team = new Team;
		}

		$team->team_name = $input['team_name'];
		$team->save();

		return $team;

	}


	


}
