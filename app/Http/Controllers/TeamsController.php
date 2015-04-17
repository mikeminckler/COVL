<?php namespace COVL\Http\Controllers;

use COVL\Http\Requests;
use COVL\Http\Controllers\Controller;

use Illuminate\Http\Request;

use COVL\Team;
use COVL\Http\Requests\StoreTeamRequest;

class TeamsController extends Controller {

	

	public function __construct(Team $team) 
	{
		$this->middleware('auth');
		$this->team = $team;
	}
	

	//
	public function index(Request $request) 
	{
		$teams = $this->team->where('hidden', '0')->orderBy('team_name')->paginate(10);

		if ($request->ajax()) {
			$html = view('teams.list', compact('teams'))->render();
			return response()->json(['html' => $html]);
		} else {
			return view('teams.index', compact('teams'));
		}

	}

	public function create() 
	{
		return view('teams.create');
	}


	public function store(StoreTeamRequest $request, $id = null) 
	{

		$team = $this->team->store($request->all(), $id);
		return redirect('teams');
	}


	public function edit($id)
	{
		$team = $this->team->find($id);

		if ($team instanceof Team) {
			return view('teams.edit', compact('team'));
		}
	}

}
