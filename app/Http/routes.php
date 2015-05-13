<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('home', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('teams', ['as' => 'teams', 'uses' => 'TeamsController@index']);
Route::get('teams/create', ['as' => 'teams.create', 'uses' => 'TeamsController@create']);
Route::post('teams/create', ['as' => 'teams.store', 'uses' => 'TeamsController@store']);
Route::get('teams/edit/{id}', ['as' => 'teams.edit', 'uses' => 'TeamsController@edit'])->where('id', '\d+');
Route::post('teams/edit/{id}', ['as' => 'teams.update', 'uses' => 'TeamsController@store'])->where('id', '\d+');

Route::get('seasons', ['as' => 'seasons', 'uses' => 'SeasonsController@index']);
Route::get('seasons/create', ['as' => 'seasons.create', 'uses' => 'SeasonsController@create']);
Route::post('seasons/create', ['as' => 'seasons.store', 'uses' => 'SeasonsController@store']);
Route::get('seasons/edit/{id}', ['as' => 'seasons.edit', 'uses' => 'SeasonsController@edit'])->where('id', '\d+');
Route::post('seasons/edit/{id}', ['as' => 'seasons.update', 'uses' => 'SeasonsController@store'])->where('id', '\d+');
Route::get('seasons/autocomplete-list', ['as' => 'seasons.autocomplete-list', 'uses' => 'SeasonsController@autocompleteList']);
Route::get('seasons/game-days', ['as' => 'seasons.game-days', 'uses' => 'SeasonsController@gameDays']);
Route::get('seasons/leagues', ['as' => 'seasons.leagues', 'uses' => 'SeasonsController@leagues']);
Route::post('seasons/leagues', ['as' => 'seasons.leagues.update', 'uses' => 'SeasonsController@storeLeagues']);
Route::get('seasons/teams', ['as' => 'seasons.teams', 'uses' => 'SeasonsController@teams']);
Route::post('seasons/teams', ['as' => 'seasons.teams.update', 'uses' => 'SeasonsController@storeTeams']);
Route::get('seasons/standings', ['as' => 'seasons.standings', 'uses' => 'SeasonsController@standings']);


Route::get('leagues', ['as' => 'leagues', 'uses' => 'LeaguesController@index']);
Route::get('leagues/create', ['as' => 'leagues.create', 'uses' => 'LeaguesController@create']);
Route::post('leagues/create', ['as' => 'leagues.store', 'uses' => 'LeaguesController@store']);
Route::get('leagues/edit/{id}', ['as' => 'leagues.edit', 'uses' => 'LeaguesController@edit'])->where('id', '\d+');
Route::post('leagues/edit/{id}', ['as' => 'leagues.update', 'uses' => 'LeaguesController@store'])->where('id', '\d+');
Route::get('leagues/autocomplete-list', ['as' => 'leagues.autocomplete-list', 'uses' => 'LeaguesController@autocompleteList']);
Route::get('leagues/populate', ['as' => 'leagues.populate', 'uses' => 'LeaguesController@populate']);



Route::get('game-days', ['as' => 'game-days', 'uses' => 'GameDaysController@index']);
Route::get('game-days/create', ['as' => 'game-days.create', 'uses' => 'GameDaysController@create']);
Route::post('game-days/create', ['as' => 'game-days.store', 'uses' => 'GameDaysController@store']);
Route::get('game-days/edit/{id}', ['as' => 'game-days.edit', 'uses' => 'GameDaysController@edit'])->where('id', '\d+');
Route::post('game-days/edit/{id}', ['as' => 'game-days.update', 'uses' => 'GameDaysController@store'])->where('id', '\d+');
Route::get('game-days/teams/{id}', ['as' => 'game-days.teams', 'uses' => 'GameDaysController@teams'])->where('id', '\d+');
Route::post('game-days/teams/{id}', ['as' => 'game-days.teams.update', 'uses' => 'GameDaysController@storeTeams'])->where('id', '\d+');
Route::get('game-days/games/{id}', ['as' => 'game-days.games', 'uses' => 'GameDaysController@games'])->where('id', '\d+');
Route::post('game-days/games/{id}', ['as' => 'game-days.games.store', 'uses' => 'GameDaysController@storeGames'])->where('id', '\d+');
Route::get('game-days/schedule/{id}', ['as' => 'game-days.schedule', 'uses' => 'GameDaysController@schedule'])->where('id', '\d+');
Route::get('game-days/results/{id}', ['as' => 'game-days.results', 'uses' => 'GameDaysController@results'])->where('id', '\d+');

Route::get('external/game-days/results/{id}', ['as' => 'external.game-days.results', 'uses' => 'ExternalController@gameDayResults'])->where('id', '\d+');

Route::get('game-sets/add', ['as' => 'game-sets.add', 'uses' => 'GameSetsController@add']);
Route::get('game-sets/delete', ['as' => 'game-sets.delete', 'uses' => 'GameSetsController@destroy']);
