<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\game;
use App\users;
use Illuminate\Support\Facades\Input;

class RealGameController extends Controller
{
    public function create()
    {
        return view('GameViews.create');
    }

    public function store()
    {
        $users = new users;
        $users->username = input::get('name');
        $users->save();
        $game = new game;
        $game->url = input::get('url');
        $game->Spieler_1 = $users->id;
        $game->save();
        echo view('GameViews.wait', ['url' => input::get('url'), 'user' => $users->id]);
    }

    public function joinID()
    {

        echo view('GameViews.joinID');
    }

    public function joinGame()
    {
        $url = input::get('url');
        if (\DB::table('games')->where('url', $url)->value('Spieler_2') === NULL) {
            $users = new users;
            $users->username = input::get('name');
            $users->save();
            \DB::table('games')->where('url', $url)->update(
                ['Spieler_2' => $users->id]
            );
            echo view('GameViews.gameview', ['user' => $users->ide, 'url' => $url]);
        } else {
            echo "Schon ein zweiter Spieler im Spiel";
        }
    }

}