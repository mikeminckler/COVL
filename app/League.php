<?php namespace COVL;

use Illuminate\Database\Eloquent\Model;

class League extends Model {

	public function store($input, $id = null) {

		if ($id) {
			$league = $this->find($id);
		} else {
			$league = new League;
		}

		$league->league_name = $input['league_name'];
		$league->save();

		return $league;

	}

	public function seasons() {
		return $this->belongsToMany('COVL\Season');
	}


}
