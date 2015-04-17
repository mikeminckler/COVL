<?php namespace COVL\Http\Controllers;

use COVL\Http\Requests;
use COVL\Http\Controllers\Controller;

use Illuminate\Http\Request;

use COVL\Season;
use COVL\Http\Requests\StoreSeasonRequest;
use COVL\League;
use COVL\Team;

class SeasonsController extends Controller {

	//

	public function __construct(Season $season, League $league, Team $team) 
	{
		$this->middleware('auth');
		$this->season = $season;
		$this->league = $league;
		$this->team = $team;
	}
	

	public function index(Request $request) 
        {
                $seasons = $this->season->where('hidden', '0')->paginate(2);

                if ($request->ajax()) {
                        $html = view('seasons.list', compact('seasons'))->render();
                        return response()->json(['html' => $html]);
                } else {
                        return view('seasons.index', compact('seasons'));
                }

        }
	
	public function create() 
	{
		return view('seasons.create');
	}


	public function store(StoreSeasonRequest $request, $id = null) 
	{

		$season = $this->season->store($request->all(), $id);
		return redirect('seasons');
	}


	public function edit($id)
	{
		$season = $this->season->find($id);

		if ($season instanceof Season) {
			return view('seasons.edit', compact('season'));
		}
	}

	public function autocompleteList() {
		$seasons = $this->season->where('hidden', '0')->get();
		$results = array();
		foreach ($seasons as $season) {
			$data = array();
			$data['id'] = $season->id;
			$data['value'] = $season->season_name;
			$data['label'] = $season->season_name;
			$results[] = $data;
		}
		return $results;
	}


	public function gameDays(Request $request) {
		$season = $this->season->find($request->id);
		if ($season instanceof Season) {
			return view('seasons.game_days', compact('season'));
		}
	}

	public function leagues(Request $request) {
                $season = $this->season->find($request->id);
                $leagues = $this->league->where('hidden', '0')->get();
                if ($season instanceof Season) {
                        return view('seasons.leagues', compact('season', 'leagues'));
                } else {
			return redirect()->back();
		}
        }

	public function storeLeagues(Request $request) {

		$season = $this->season->find($request->id);
		$season->leagues()->detach();
		if ($season instanceof Season) {
			if ($request->leagues) {
				foreach ($request->leagues as $league_id => $foo) {
					$league = $this->league->find($league_id);
					if ($league instanceof League) {
						$season->leagues()->attach($league);				
					}
				}	
			}
		}
		return redirect()->route('seasons'); 
	}

	public function teams(Request $request) {
                $season = $this->season->find($request->id);
                $teams = $this->team->where('hidden', '0')->orderBy('team_name')->get();
                if ($season instanceof Season) {
                        return view('seasons.teams', compact('season', 'teams'));
                } else {
			return redirect()->back();
		}
        }

	public function storeTeams(Request $request) {

		$season = $this->season->find($request->id);
		$season->teams()->detach();
		if ($season instanceof Season) {
			if ($request->teams) {
				foreach ($request->teams as $team_id => $foo) {
					$team = $this->team->find($team_id);
					if ($team instanceof Team) {
						$season->teams()->attach($team);				
					}
				}	
			}
		}
		return redirect()->route('seasons'); 
	}



}
