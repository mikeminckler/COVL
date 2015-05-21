<?php namespace COVL\Http\Controllers;

use COVL\Http\Requests;
use COVL\Http\Controllers\Controller;

use Illuminate\Http\Request;

use COVL\GameDay;
use COVL\GameSet;
use COVL\Game;
use COVL\Season;
use COVL\Point;
use COVL\Http\Requests\StoreGameDayRequest;

use Illuminate\Database\Eloquent\Collection;

class GameDaysController extends Controller {

	public function __construct(GameDay $game_day, Season $season, Game $game, GameSet $game_set, Point $point) 
	{
		$this->middleware('auth');
		$this->game_day = $game_day;
		$this->game = $game;
		$this->game_set = $game_set;
		$this->season = $season;
		$this->point = $point;
	}
	

	public function index(Request $request) 
        {
                $game_days = $this->game_day->where('hidden', '0')->paginate(20);

                if ($request->ajax()) {
                        $html = view('game_days.list', compact('game_days'))->render();
                        return response()->json(['html' => $html]);
                } else {
                        return view('game_days.index', compact('game_days'));
                }

        }
	
	public function create(Request $request) 
	{
		//$seasons = $this->season->where('hidden', '0')->lists('season_name', 'id');
		if ($request->season_id) {
			$season = $this->season->find($request->season_id);
		}
		return view('game_days.create', compact('season'));
	}


	public function store(StoreGameDayRequest $request, $id = null) 
	{

		$game_day = $this->game_day->store($request->all(), $id);
		return redirect()->route('game-days');
	}

	public function edit($id)
	{
		$game_day = $this->game_day->find($id);
		$season = $game_day->season;

		if ($game_day instanceof GameDay) {
			return view('game_days.edit', compact('game_day', 'season'));
		}
	}

	public function teams($id) {
		$game_day = $this->game_day->find($id);
                if ($game_day instanceof GameDay) {
			return view('game_days.teams', compact('game_day'));
		} else {
			return redirect()->back();
		}
	}

	public function storeTeams(Request $request, $id) {
		$game_day = $this->game_day->find($id);
                if ($game_day instanceof GameDay) {
			$game_day->storeTeams($request->all());
			$game_day->schedule();
			return view('game_days.teams', compact('game_day'));
			//return redirect()->route('game-days.teams', ['id' => $game_day->id]);
		} else {
			return redirect()->back();
		}
	}

	public function games($id) {
		$game_day = $this->game_day->find($id);
		$hide_teams = null;
		$best_of = null;
                if ($game_day instanceof GameDay) {
			return view('game_days.games', compact('game_day', 'hide_teams', 'best_of'));
		} else {
			return redirect()->back();
		}

	}


	public function storeGames(Request $request, $id) {
		$game_day = $this->game_day->find($id);
                if ($game_day instanceof GameDay) {
		
			if (count($request->game_score) > 0) {
				foreach ($request->game_score as $game_id => $game_data) {
					$game = $this->game->find($game_id);
					if ($game instanceof Game) {
						foreach ($game_data as $set_number => $set_info) {
							if (array_key_exists('game_set_id', $set_info)) {
								$game_set = $this->game_set->find($set_info['game_set_id']);
							} else {
								$game_set = new GameSet;
							}
							$game_set->game_id = $game->id;
							$game_set->number = $set_number;
							$game_set->save();

							$old_home_count = count($this->point->where('game_set_id', $game_set->id)->where('team_id', $game->home_team->id)->get());
							$old_away_count = count($this->point->where('game_set_id', $game_set->id)->where('team_id', $game->away_team->id)->get());
							
							if ($old_home_count < $set_info['home_team']) {
								for ($i = $old_home_count; $i < $set_info['home_team']; $i++) {
									$point = new Point;
									$point->game_set_id = $game_set->id;
									$point->team_id = $game->home_team->id;
									$point->save();
								}
							} else if($old_home_count > $set_info['home_team'])  {
								$delete_count = $old_home_count - $set_info['home_team'];
								$this->point->where('game_set_id', $game_set->id)->where('team_id', $game->home_team->id)->orderBy('id', 'desc')->limit($delete_count)->delete();
							}
		
							if ($old_away_count < $set_info['away_team']) {						
								for ($i = $old_away_count; $i < $set_info['away_team']; $i++) {
									$point = new Point;
									$point->game_set_id = $game_set->id;
									$point->team_id = $game->away_team->id;
									$point->save();
								}
							} else if ($old_away_count > $set_info['away_team']) {
								$delete_count = $old_away_count - $set_info['away_team'];
								$this->point->where('game_set_id', $game_set->id)->where('team_id', $game->away_team->id)->orderBy('id', 'desc')->limit($delete_count)->delete();
							}
						}
					}
				}

				return redirect()->route('game-days.games', ['id' => $game_day->id]);
			} else {
				return redirect()->back();
			}
                } else {
                        return redirect()->back();
                }

	}

	public function schedule($id) {
		$game_day = $this->game_day->find($id);
                if ($game_day instanceof GameDay) {
		
			$game_day->schedule();

                        return redirect()->route('game-days.games', ['id' => $game_day->id]);
                } else {
                        return redirect()->back();
                }
	}

	public function results($id) {
		$game_day = $this->game_day->find($id);
		$hide_teams = null;
                $best_of = 3;
                if ($game_day instanceof GameDay) {
			return view('game_days.results', compact('game_day', 'hide_teams', 'best_of'));
                } else {
                        return redirect()->back();
                }
	}


	public function printSchedule($id) {
		$game_day = $this->game_day->find($id);

		if ($game_day instanceof GameDay) {
                        return view('game_days.print', compact('game_day'));
                } else {
                        return redirect()->back();
                }

	}


}
