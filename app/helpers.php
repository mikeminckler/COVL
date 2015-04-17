<?php


	function results($games) {

		$standings = array();
		foreach ($games as $game) {
			foreach ($game->gameSets as $game_set) {
				$home_team = $game_set->game->home_team;
				$away_team = $game_set->game->away_team;

				$home_points = count($game_set->home_points);
				$away_points = count($game_set->away_points);

				if ($home_points > $away_points) {
					if (!array_key_exists($home_team->id, $standings)) {
						$standings[$home_team->id] = 0;
					}
					$standings[$home_team->id] = $standings[$home_team->id] + 1;
				} else if ($away_points > $home_points) {
					if (!array_key_exists($away_team->id, $standings)) {
						$standings[$away_team->id] = 0;
					}
					$standings[$away_team->id] = $standings[$away_team->id] + 1;
				}
			}
		}

		arsort($standings);
		$place = 1;
		$return = '';
		foreach ($standings as $team_id => $points) {
			$team = COVL\Team::find($team_id);
			$return .= '<div class="row">';
			$return .= '<div class="column" data-column="1">'.$place.'</div>';
			$return .= '<div class="column" data-column="2">'.$team->team_name.'</div>';
			$return .= '<div class="column" data-column="3">'.$points.'</div>';
			$return .= '</div>';
			$place ++;
		}

		return $return;

	}

