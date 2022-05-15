<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\LeaguesController;
use App\Http\Controllers\GameDaysController;
use App\Http\Controllers\ExternalController;
use App\Http\Controllers\GameSetsController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('teams', [TeamsController::class, 'index'])->name('teams');
Route::get('teams/create', [TeamsController::class, 'create'])->name('teams.create');
Route::post('teams/create', [TeamsController::class, 'store'])->name('teams.store');
Route::get('teams/edit/{id}', [TeamsController::class, 'edit'])->name('teams.edit')->where('id', '\d+');
Route::post('teams/edit/{id}', [TeamsController::class, 'store'])->name('teams.update')->where('id', '\d+');

Route::get('seasons', [SeasonsController::class, 'index'])->name('seasons');
Route::get('seasons/create', [SeasonsController::class, 'create'])->name('seasons.create');
Route::post('seasons/create', [SeasonsController::class, 'store'])->name('seasons.store');
Route::get('seasons/edit/{id}', [SeasonsController::class, 'edit'])->name('seasons.edit')->where('id', '\d+');
Route::post('seasons/edit/{id}', [SeasonsController::class, 'store'])->name('seasons.update')->where('id', '\d+');
Route::get('seasons/autocomplete-list', [SeasonsController::class, 'autocompleteList'])->name('seasons.autocomplete-list');
Route::get('seasons/game-days', [SeasonsController::class, 'gameDays'])->name('seasons.game-days');
Route::get('seasons/leagues', [SeasonsController::class, 'leagues'])->name('seasons.leagues');
Route::post('seasons/leagues', [SeasonsController::class, 'storeLeagues'])->name('seasons.leagues.update');
Route::get('seasons/teams', [SeasonsController::class, 'teams'])->name('seasons.teams');
Route::post('seasons/teams', [SeasonsController::class, 'storeTeams'])->name('seasons.teams.update');
Route::get('seasons/standings', [SeasonsController::class, 'standings'])->name('seasons.standings');

Route::get('leagues', [LeaguesController::class, 'index'])->name('leagues');
Route::get('leagues/create', [LeaguesController::class, 'create'])->name('leagues.create');
Route::post('leagues/create', [LeaguesController::class, 'store'])->name('leagues.store');
Route::get('leagues/edit/{id}', [LeaguesController::class, 'edit'])->name('leagues.edit')->where('id', '\d+');
Route::post('leagues/edit/{id}', [LeaguesController::class, 'store'])->name('leagues.update')->where('id', '\d+');
Route::get('leagues/autocomplete-list', [LeaguesController::class, 'autocompleteList'])->name('leagues.autocomplete-list');
Route::get('leagues/populate', [LeaguesController::class, 'populate']);

Route::get('game-days', [GameDaysController::class, 'index'])->name('game-days');
Route::get('game-days/create', [GameDaysController::class, 'create'])->name('game-days.create');
Route::post('game-days/create', [GameDaysController::class, 'store'])->name('game-days.store');
Route::get('game-days/edit/{id}', [GameDaysController::class, 'edit'])->name('game-days.edit')->where('id', '\d+');
Route::post('game-days/edit/{id}', [GameDaysController::class, 'store'])->name('game-days.update')->where('id', '\d+');
Route::get('game-days/teams/{id}', [GameDaysController::class, 'teams'])->name('game-days.teams')->where('id', '\d+');
Route::post('game-days/teams/{id}', [GameDaysController::class, 'storeTeams'])->name('game-days.teams.update')->where('id', '\d+');
Route::get('game-days/games/{id}', [GameDaysController::class, 'games'])->name('game-days.games')->where('id', '\d+');
Route::post('game-days/games/{id}', [GameDaysController::class, 'storeGames'])->name('game-days.games.store')->where('id', '\d+');
Route::get('game-days/schedule/{id}', [GameDaysController::class, 'schedule'])->name('game-days.schedule')->where('id', '\d+');
Route::get('game-days/results/{id}', [GameDaysController::class, 'results'])->name('game-days.results')->where('id', '\d+');
Route::get('game-days/print-schedule/{id}', [GameDaysController::class, 'printSchedule'])->name('game-days.print-schedule')->where('id', '\d+');

Route::get('external/game-days/results/{id}', [ExternalController::class, 'gameDayResults'])->name('external.game-days.results')->where('id', '\d+');

Route::get('game-sets/add', [GameSetsController::class, 'add'])->name('game-sets.add');
Route::get('game-sets/delete', [GameSetsController::class, 'destroy'])->name('game-sets.delete');
