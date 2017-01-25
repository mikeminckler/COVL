<?php namespace App;

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
		return $this->hasMany('App\GameSet')->where('hidden', '0');
	}

	public function league() {
		return $this->belongsTo('App\League');
	}

	public function team_points($team) {

		$points = 0;
		if ($this->home_team_id == $team->id) {
			foreach ($this->gameSets as $game_set) {
				$points += count($game_set->home_points);
			}
		} else {
			foreach ($this->gameSets as $game_set) {
				$points += count($game_set->away_points);
			}
		}
		return $points;

	}

	public function team_game_sets($team) {

		$home_game_sets = 0;
		$away_game_sets = 0;
		
		foreach ($this->gameSets as $game_set) {

			$home_points = count($game_set->home_points);
			$away_points = count($game_set->away_points);

			$min_score_reached = false;
			if ($this->league->minimum_points > 0) {
				if ((count($game_set->home_points) + count($game_set->away_points)) >= $this->league->minimum_points) {
					$min_score_reached = true;
				}
			} else {
				$min_score_reached = true;
			}

			if ($min_score_reached) {
				if ($home_points > $away_points) {
					$home_game_sets ++;
				} else if ($away_points > $home_points) {
					$away_game_sets ++;
				}
			}
		}


		if ($this->home_team_id == $team->id) {
			return $home_game_sets;
		} else {
			return $away_game_sets;
		}

	}


	public function results() {

		$home = array();
		$away = array();

		$home['sets'] = 0;
		$away['sets'] = 0;

		foreach ($this->gameSets as $game_set) {
			$home_points = count($game_set->home_points);
			$away_points = count($game_set->away_points);

			$min_score_reached = false;
			if ($this->league->minimum_points > 0) {
				if ((count($game_set->home_points) + count($game_set->away_points)) >= $this->league->minimum_points) {
					$min_score_reached = true;
				}
			} else {
				$min_score_reached = true;
			}

			if ($min_score_reached) {
				if ($home_points > $away_points) {
					$home['sets'] ++;
				} else if ($away_points > $home_points) {
					$away['sets'] ++;
				}
			}

		}
		
		$return = array();
	
		if ($home['sets'] > $away['sets']) {
			$return[$this->home_team->id] = $home['sets'];
		} else if ($home['sets'] < $away['sets']) {
			$return[$this->away_team->id] = $away['sets'];
		} else {
			$return[$this->home_team->id] = $home['sets'];
			$return[$this->away_team->id] = $away['sets'];
		}

		return $return;
	}


}
