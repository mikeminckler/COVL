<?php namespace COVL;

use Illuminate\Database\Eloquent\Model;

class Game extends Model {

	public function store($input, $id = null) {
		if ($id) {
			$game = $this->find($id);
		} else {
			$game = new $this;
		}

		$game->league_id = $input['league_id'];
		$game->home_team_id = $input['home_team_id'];
		$game->away_team_id = $input['away_team_id'];
		$game->round = $input['round'];
		$game->save();

		return $game;

	}

	public function getHomeTeamAttribute() {
		return Team::find($this->home_team_id);
	}

	public function getAwayTeamAttribute() {
		return Team::find($this->away_team_id);
	}

	public function gameSets() {
		return $this->hasMany('COVL\GameSet')->where('hidden', '0');
	}

}
