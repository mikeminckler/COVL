<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\GameDay;

class ExternalController extends Controller {


	public function __construct(GameDay $game_day) {
		$this->middleware('guest');
		$this->game_day = $game_day;
	}

	public function gameDayResults($id) {

		$game_day = $this->game_day->find($id);
		$hide_teams = null;
		$best_of = 3;
		
                if ($game_day instanceof GameDay) {
                        return view('external.results', compact('game_day', 'hide_teams', 'best_of'));
                } else {
                        return redirect()->back();
                }


	}

	

}
