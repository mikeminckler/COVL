<?php namespace COVL;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

use Carbon\Carbon;

use COVL\League;
use COVL\Game;
use COVL\Team;

class GameDay extends Model {

	//
	protected $dates = ['start_time', 'end_time'];

	public function store($input, $id = null) {

		if ($id) {
			$game_day = $this->find($id);
		} else {
			$game_day = new GameDay;
		}

		$end_time = Carbon::parse(Carbon::parse($input['start_time'])->format('Y-m-d').' '.$input['end_time']);

		$game_day->game_day_name = $input['game_day_name'];
		$game_day->start_time = Carbon::parse($input['start_time']);
		$game_day->end_time = $end_time;
		$game_day->season_id = $input['season_id'];
		$game_day->save();

		return $game_day;

	}


	public function season() {
		return $this->belongsTo('COVL\Season');
	}

	public function getLinkedNameAttribute() {
		return link_to_route('seasons.game-days', $this->name, ['id' => $this->season->id]);
	}


	public function getNameAttribute() {
		return $this->season->season_name.' - '.$this->game_day_name.' - '.$this->start_time->format('D M j, g:ia');
	}

	public function teams($league = null) {
		if ($league instanceof League) {
			return $this->belongsToMany('COVL\Team')->wherePivot('league_id', $league->id);
		} else {
			return $this->belongsToMany('COVL\Team');
		}
	}

	public function games($league = null, $round = null) {
		if ($league instanceof League && $round > 0) {
			return $this->hasMany('COVL\Game')->where('league_id', $league->id)->where('round', $round)->orderBy('away_team_id', 'desc');
		} elseif ($league instanceof League) {
			return $this->hasMany('COVL\Game')->where('league_id', $league->id)->orderBy('away_team_id', 'desc');
		} else {
			return $this->hasMany('COVL\Game');
		}
	}


	public static function hasBye($games) {
		$teams = new Collection;
		foreach ($games as $game) {
			$teams = $teams->add($game->home_team);
			$teams = $teams->add($game->away_team);
		}
		$teams = $teams->unique();
		if ($teams->contains(1)) {
			return true;
		} else {
			return false;
		}
	}


	public function storeTeams($input) {

		$this->teams()->detach();
		if (array_key_exists('league_teams', $input)) {
			foreach ($input['league_teams'] as $league_id => $teams) {
				$league = League::find($league_id);
				foreach ($teams as $team_id) {
					$team = Team::find($team_id);
					$this->teams($league)->attach($team, ['league_id' => $league->id]);
				}
			}
		}

	}

	public function unUsedTeams() {

		$teams = $this->season->teams;
		$used_teams = $this->teams;

		$new_teams = $teams->filter(function($team) use($used_teams) {
			if (!$used_teams->contains($team->id)) {
				return true;
			}
		});
		return $new_teams;
	}


	public function getLengthAttribute() {
		return $this->start_time->diffInMinutes($this->end_time);
	}

	public function rounds($league) {
		return count($this->hasMany('COVL\Game')->where('league_id', $league->id)->groupBy('round')->get());
	}

	public function roundStartTime($league, $round) {
		$round_length = round($this->length / $this->rounds($league));
		return $this->start_time->addMinutes(($round_length * $round) - $round_length)->format('H:i');
	}

	public function schedule() {

		$games = $this->games()->delete();

		$leagues = $this->season->leagues;

		foreach ($leagues as $league) {

			$teams = $this->teams($league)->get();

			$team_ids = array();
			foreach ($teams as $team) {
				$team_ids[] = $team->id;
			}

			$teams = $team_ids;

			$rounds = array();

			if (count($teams) > 0) {

				// remove all the old games, but only if there is no game data
				$old_games = $this->games($league);

				// if we have an odd number of teams add a 'bye' team
				if (count($teams)%2 != 0){
					array_push($teams,"1");
				}
				$away = array_splice($teams,(count($teams)/2));
				$home = $teams;
				for ($i=0; $i < count($home)+count($away)-1; $i++){
					for ($j=0; $j<count($home); $j++){
						if ($home[$j] == 1) {
							$rounds[$i][$j]["home"]=$away[$j];
							$rounds[$i][$j]["away"]=$home[$j];
						} else {
							$rounds[$i][$j]["home"]=$home[$j];
							$rounds[$i][$j]["away"]=$away[$j];
						}
					}
					if(count($home)+count($away)-1 > 2){
						array_unshift($away,current(array_splice($home,1,1)));
						array_push($home,array_pop($away));
					}
				}

				foreach ($rounds as $round_id => $games) {
					foreach ($games as $game_number => $game_teams) {
						$game = new Game;
						$game->game_day_id = $this->id;
						$game->league_id = $league->id;
						$game->home_team_id = $game_teams['home'];
						$game->away_team_id = $game_teams['away'];
						$game->round = $round_id + 1;
						$game->save();
					}
				} 

			}

		}


	}

}
