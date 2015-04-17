<?php namespace COVL;

use Illuminate\Database\Eloquent\Model;

class GameSet extends Model {

	public function home_points() {
		return $this->hasMany('COVL\Point')->where('team_id', $this->game->home_team->id);
	}

	public function away_points() {
		return $this->hasMany('COVL\Point')->where('team_id', $this->game->away_team->id);
	}


	public function game() {
		return $this->belongsTo('COVL\Game');
	}

}
