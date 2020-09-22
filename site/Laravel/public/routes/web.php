<?php
use App\game;

Route::get('/', 'PagesController@home');
Route::get('impressum', 'PagesController@imprint');
Route::get('game', 'GameController@start');

# Start, join and restart a game
Route::get('game/{id}', 'GameController@show');
Route::post('game/{id}', 'GameController@join');
Route::get('game/{id}/newGame', 'GameController@newGame');

# Get game data
Route::get('game/{id}/getStats', 'GameController@getStats');
Route::get('game/{id}/getScore', 'GameController@getGamescore');
Route::get('game/{id}/getSpieler1', 'GameController@getSpieler1');
Route::get('game/{id}/getSpieler2', 'GameController@getSpieler2');

# Get and set players
Route::get('game/{id}/getPlayers', 'GameController@getPlayers');
Route::post('/game/{id}/setPlayer','GameController@setPlayer');

# Get and set choices
Route::get('game/{id}/getChoices', 'GameController@getChoices');
Route::post('game/{id}/setChoice', 'GameController@setChoice');

# Get results
Route::get('game/{id}/getResults', 'GameController@getResults');

# Contact
Route::get('contact',
    ['as' => 'contact', 'uses' => 'ContactController@create']);
Route::post('contact',
    ['as' => 'contact_store', 'uses' => 'ContactController@store']);


Route::get('joinID', 'RealGameController@joinID');

Route::get('wait', 'GameController@wait');

Route::get('create', 'GameController@create');

Route::post('start/{url}','RealGameController@store');

Route::get ('create','RealGameController@create');

Route::get('join/{url}',function ($url){
    echo view('GameViews.join',['url'=>$url]);
});

Route::post('join/{url}', 'RealGameController@joinGame');


Route::post('wait',array('uses' => 'RealGameController@wait'));
