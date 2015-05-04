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

	public function winner() {

		$home = array();
		$away = array();

		$home['sets'] = 0;
		$away['sets'] = 0;

		foreach ($this->gameSets as $game_set) {
			$home_points = count($game_set->home_points);
			$away_points = count($game_set->away_points);

			if ($home_points > $away_points) {
				$home['sets'] ++;
			} else if ($away_points > $home_points) {
				$away['sets'] ++;
			}

		}
		
		$return = array();
	
		if ($home['sets'] > $away['sets']) {
			$return[$this->home_team->id] = $home['sets'];
		} else if ($home['sets'] < $away['sets']) {
			$return[$this->away_team->id] = $away['sets'];
		}

		return $return;
	}


}
