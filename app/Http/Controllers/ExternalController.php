<?php namespace COVL\Http\Controllers;

use COVL\Http\Requests;
use COVL\Http\Controllers\Controller;

use Illuminate\Http\Request;

use COVL\GameDay;

class ExternalController extends Controller {


	public function __construct(GameDay $game_day) {
		$this->middleware('guest');
		$this->game_day = $game_day;
	}

	public function gameDayResults($id) {

		$game_day = $this->game_day->find($id);
                if ($game_day instanceof GameDay) {
                        return view('external.results', compact('game_day'));
                } else {
                        return redirect()->back();
                }


	}

	

}
