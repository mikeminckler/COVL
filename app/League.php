<?php namespace COVL;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

use COVL\GameDay;
use COVL\Team;

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

	public function games($season) {
		$game_days = $season->gameDays;
		$games = new Collection;

		foreach ($game_days as $game_day) {
			$games = $games->merge($game_day->games($this)->get());
		}

		return $games;
	}

	public function gameDays($season) {
		$game_days = $season->gameDays()->whereHas('games', function($query) {
			$query->where('league_id', $this->id);
		});
		return $game_days;
	}


	public function standings($game_days) {
		
		$total_games = new Collection;
		$standings = array();
		$game_day_ids = array();
		foreach ($game_days as $game_day) {
			$game_day_ids[] = $game_day->id;
		}

                foreach ($game_days as $game_day) {
			$games = $game_day->games()->where('league_id', $this->id)->get();
                        $total_games = $total_games->merge($games);

			foreach ($games as $game) {
				$home_team = $game->home_team;
				$away_team = $game->away_team;


				if (!array_key_exists($home_team->id, $standings)) {
					$standings[$home_team->id] = array();
					$standings[$home_team->id]['total'] = 0;
					$standings[$home_team->id]['weeks'] = array();
				}

				if (!array_key_exists($away_team->id, $standings)) {
					$standings[$away_team->id] = array();
					$standings[$away_team->id]['total'] = 0;
					$standings[$away_team->id]['weeks'] = array();
				}

				if (!array_key_exists($game_day->id, $standings[$home_team->id]['weeks'])) {
					foreach ($game_day_ids as $game_day_id) {
						$standings[$home_team->id]['weeks'][$game_day_id] = 0;
					}
				}
				if (!array_key_exists($game_day->id, $standings[$away_team->id]['weeks'])) {
					foreach ($game_day_ids as $game_day_id) {
						$standings[$away_team->id]['weeks'][$game_day_id] = 0;
					}
				}

				$winner = $game->winner();

				foreach ($winner as $team_id => $points) {
					$standings[$team_id]['total'] = $standings[$team_id]['total'] + $points;
					$standings[$team_id]['weeks'][$game_day->id] = $standings[$team_id]['weeks'][$game_day->id] + $points;
				}
			}
                }

		arsort($standings);

		return $standings;

	}


	public function displayStandings($game_days, $show_weeks = true) {

		if ($game_days instanceof GameDay) {
			$game_day = $game_days;
			$game_days = new Collection;
			$game_days = $game_days->add($game_day);
		}


		$standings = $this->standings($game_days);
		$game_day_ids = array();
		foreach ($game_days as $game_day) {
			$game_day_ids[] = $game_day->id;
		}
	
		$place = 1;
		$return = '<div class="row">';
		$return .= '<div class="column" data-column="1">Place</div>';
		$return .= '<div class="column" data-column="2">Team</div>';
		$return .= '<div class="column" data-column="3">Total</div>';

		if ($show_weeks) {
			foreach ($game_day_ids as $game_day_id) {
				$return .= '<div class="column" style="width: 50px">'.GameDay::find($game_day_id)->game_day_name.'</div>';
			}
		}

		$return .= '</div>';
		foreach ($standings as $team_id => $team_info) {
			$team = Team::find($team_id);
			$return .= '<div class="row">';
			$return .= '<div class="column" data-column="1">'.$place.'</div>';
			$return .= '<div class="column" data-column="2">'.$team->team_name.'</div>';
			$return .= '<div class="column" data-column="3">'.$team_info['total'].'</div>';

			if ($show_weeks) {
				foreach ($team_info['weeks'] as $game_day_id => $game_day_points) {
					$return .= '<div class="column" style="width: 50px">'.$game_day_points.'</div>';
				}
			}

			$return .= '</div>';
			$place ++;
		}

		return $return;

	}

}
