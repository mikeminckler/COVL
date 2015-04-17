<?php namespace COVL;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Season extends Model {


	protected $dates = ['start_date', 'end_date'];


	public function store($input, $id = null) {

		if ($id) {
			$season = $this->find($id);
		} else {
			$season = new Season;
		}

		$season->season_name = $input['season_name'];
		$season->start_date = $input['start_date'];
		$season->end_date = $input['end_date'];
		$season->save();

		return $season;

	}


	public function getStartDateAttribute($value) {
		return Carbon::parse($value)->format('Y-m-d');
	}

	public function getEndDateAttribute($value) {
		return Carbon::parse($value)->format('Y-m-d');
	}

	public function gameDays() {
		return $this->hasMany('COVL\GameDay');
	}

	public function leagues() {
		return $this->belongsToMany('COVL\League');
	}

	public function teams() {
		return $this->belongsToMany('COVL\Team')->orderBy('team_name');
	}

}
