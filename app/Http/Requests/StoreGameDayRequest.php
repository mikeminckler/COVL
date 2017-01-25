<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreGameDayRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'game_day_name' => 'required',
			'start_time' => 'required|date',
			'end_time' => 'required',
			'season_id' => 'required',
		];
	}

}
