<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreSeasonRequest extends Request {

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
			'season_name' => 'required',
			'start_date' => 'required|date|before:end_date',
			'end_date' => 'required|date|after:start_date'
		];
	}

}
