<?php namespace COVL\Http\Controllers;

use COVL\Http\Requests;
use COVL\Http\Controllers\Controller;

use Illuminate\Http\Request;

use COVL\Game;
use COVL\GameSet;

class GameSetsController extends Controller {

	public function __construct(Game $game, GameSet $game_set) 
	{
		$this->middleware('auth');
		$this->game = $game;
		$this->game_set = $game_set;
	}
	
	public function add(Request $request) {
		$set_number = $request->set_number;
		$game = $this->game->find($request->game_id);
		$home_points = null;
		$away_points = null;
		if ($game instanceof Game) {
			$html = view('game_sets.display', compact('game', 'set_number', 'home_points', 'away_points'))->render();
                        return response()->json(['html' => $html]);
		}
	}


	public function destroy(Request $request) {
		$game_set = $this->game_set->find($request->game_set_id);
		if ($game_set instanceof GameSet) {
			$game_set->hidden = true;
			$game_set->save();
		}
	}

}
