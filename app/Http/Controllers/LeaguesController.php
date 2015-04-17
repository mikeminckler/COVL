<?php namespace COVL\Http\Controllers;

use COVL\Http\Requests;
use COVL\Http\Controllers\Controller;

use Illuminate\Http\Request;

use COVL\League;
use COVL\Http\Requests\StoreLeagueRequest;

class LeaguesController extends Controller {

	public function __construct(League $league) 
	{
		$this->middleware('auth');
		$this->league = $league;
	}
	

	public function index(Request $request) 
        {
                $leagues = $this->league->where('hidden', '0')->paginate(10);

                if ($request->ajax()) {
                        $html = view('leagues.list', compact('leagues'))->render();
                        return response()->json(['html' => $html]);
                } else {
                        return view('leagues.index', compact('leagues'));
                }

        }
	
	public function create() 
	{
		return view('leagues.create');
	}


	public function store(StoreLeagueRequest $request, $id = null) 
	{

		$league = $this->league->store($request->all(), $id);
		return redirect('leagues');
	}


	public function edit($id)
	{
		$league = $this->league->find($id);

		if ($league instanceof League) {
			return view('leagues.edit', compact('league'));
		}
	}

	public function autocompleteList() {
		$leagues = $this->league->where('hidden', '0')->get();
		$results = array();
		foreach ($leagues as $league) {
			$data = array();
			$data['id'] = $league->id;
			$data['value'] = $league->league_name;
			$data['label'] = $league->league_name;
			$results[] = $data;
		}
		return $results;
	}

/*
	public function gameDays(Request $request) {
		$league = $this->league->find($request->id);
		if ($league instanceof League) {
			return view('leagues.game_days', compact('league'));
		}
	}
*/
}
