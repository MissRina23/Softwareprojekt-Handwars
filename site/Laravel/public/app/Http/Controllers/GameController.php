<?php

namespace App\Http\Controllers;


use App\game;
use App\users;
use App\gamescore;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Null_;

class GameController extends Controller
{
    public function start()
    {
        return view('game');
    }

    public function show(Request $request, $id)
    {
        if (!$request->session()->has($id)) {
            $isHost = is_null(DB::table('games')->where('url', $id)->first());
            $request->session()->put($id, $isHost);
        }
	$request->session()->put('lastUpdated', 0);
	$request->session()->put('choicesLastUpdated', 0);
	$request->session()->put('resultsLastUpdated', 0);
        return view('game', ['id' => $id]);
    }

    public function setPlayer(Request $request, $id)
    {
	Log::info("test");
        $name = $request->input('name');
        $isHost = is_null(DB::table('games')->where('url', $id)->first());
        $users = new users;
        $users->username = $name;
        $users->save();
        if ($isHost) {
            $game = new game;
	    $game->url = $id;
	    $gamescore = new gamescore;
	    $gamescore->Siege_Spieler_1 = 0;
	    $gamescore->Siege_Spieler_2 = 0;
	    $gamescore->Unentschieden = 0;
	    $gamescore->Gesamte_Spiele = 0;
	    $gamescore->save();
	    $game->gamescore = $gamescore->id;
            $game->Spieler_1 = $users->id;
            $game->save();
        } else {
	    $game = Game::where('url', $id)->first();
	    $game->Spieler_2 = $users->id;
	    $game->push();
        }
	return response()->json($isHost);
    }

    public function getStats(Request $request, $id)
    {
      $lastUpdated = (string)$request->session()->get('lastUpdated');
      $currentTime = date("Y-m-d H:i:s");
      Log::info($lastUpdated . "_" . $currentTime);
      Log::info("\n");
      if($lastUpdated == $currentTime){
        $result = DB::table('games')->where('url', $id)->first();
        return response()->json($result);
      } 
      for($i = 0; $i <= 60; $i++){
        usleep(1000*500);
        $result = DB::table('games')->where('url', $id)->first();
        $data = $result != null ? $result->updated_at : null;
        $currData = $request->session()->get('lastUpdated');
        $newData = strcmp($currData, $data);
        if($newData != 0 || $currData === 0) break;
      }
      $request->session()->put('lastUpdated', $data);
      return response()->json($result);
    }

    public function setChoice(Request $request, $id)
    {
        switch ($request->input('wahl')) {
            case "schere":
                $this->choiceSchere($request, $id);
                break;
            case "stein":
                $this->choiceStein($request, $id);
                break;
            case "papier":
                $this->choicePapier($request, $id);
                break;
        }
        echo $request->session()->get($id);
        return $request->input('wahl');
    }

    public function choiceSchere(Request $request, $id)
    {
        $this->insertchoice($request, $id, 'scissors');
    }

    public function choiceStein(Request $request, $id)
    {
        $this->insertchoice($request, $id, 'stone');
    }

    public function choicePapier(Request $request, $id)
    {
        $this->insertchoice($request, $id, 'paper');
    }

    private function insertchoice($request, $gameurl, $wert)
    {
       if ($request->session()->get($gameurl) == 1) {
         $game = Game::where('url', $gameurl)->first();
         $game->Choice_Spieler_1 = $wert;
	 $game->push();
       } else {
         $game = Game::where('url', $gameurl)->first();
         $game->Choice_Spieler_2 = $wert;
         $game->push();
        }
        $choice1 = DB::table('games')->where('url', $gameurl)->value('Choice_Spieler_1');
        $choice2 = DB::table('games')->where('url', $gameurl)->value('Choice_Spieler_2');
        $Spieler1 = DB::table('games')->where('url', $gameurl)->value('Spieler_1');
        $Spieler2 = DB::table('games')->where('url', $gameurl)->value('Spieler_2');
        $Spieler_1 = DB::table('users')->where('id', $Spieler1)->value('username');
        $Spieler_2 = DB::table('users')->where('id', $Spieler2)->value('username');
        if (!is_null($choice1) && !is_null($choice2)) {
            if ($choice1 == $choice2) {
                $gewinner = "unentschieden";
            } else if ($choice1 === "paper" && $choice2 === "stone") {
                $gewinner = $Spieler_1;
            } else if ($choice1 === "scissors" && $choice2 === "paper") {
                $gewinner = $Spieler_1;
            } else if ($choice1 === "stone" && $choice2 === "scissors") {
                $gewinner = $Spieler_1;
            } else {
                $gewinner = $Spieler_2;
            }
  	  $game = Game::where('url', $gameurl)->first();
	  $game->Winner = $gewinner;
	  $game->push();

	  $gamescore = Gamescore::where('id', $game->gamescore)->first();
          if($gewinner == $Spieler_1) {
            $gamescore->Siege_Spieler_1 = $gamescore->Siege_Spieler_1 + 1; }
	  else if ($gewinner == $Spieler_2) {
	    $gamescore->Siege_Spieler_2 = $gamescore->Siege_Spieler_2 + 1; }
	  else {
	    $gamescore->Unentschieden = $gamescore->Unentschieden + 1; }
	  $gamescore->Gesamte_Spiele = $gamescore->Gesamte_Spiele + 1;
	  $gamescore->push();
        }
    }


    public function newGame(Request $request, $id)
    {
	 $game = Game::where('url', $id)->first();
	 $game->Choice_Spieler_1 = null;
	 $game->Choice_Spieler_2 = null;
	 $game->Winner = null;
	 $game->push();
    }

    public function getSpieler1(Request $request,$id){
        $game = Game::where('url', $id)->first();
        $user =  Users::where('id',$game->Spieler_1)->first();
        return response()->json($user);

    }
    public function getSpieler2(Request $request,$id){
        $game = Game::where('url', $id)->first();
        $user =  Users::where('id',$game->Spieler_2)->first();
        return response()->json($user);

    }

    public function getGamescore(Request $request,$id){
      $lastUpdated = (string)$request->session()->get('lastUpdated');
      $currentTime = date("Y-m-d H:i:s");
      Log::info($lastUpdated . "_" . $currentTime);
      Log::info("\n");
      if($lastUpdated == $currentTime){
        $game = DB::table('games')->where('url', $id)->first();
        $result = DB::table('gamescore')->where('id',$game->gamescore)->first();
        return response()->json($result);
      }
      for($i = 0; $i <= 60; $i++){
        usleep(1000*500);
        $game = DB::table('games')->where('url', $id)->first();
        $result = DB::table('gamescore')->where('id',$game->gamescore)->first();
        $data = $result != null ? $result->updated_at : null;
        $currData = $request->session()->get('lastUpdated');
        $newData = strcmp($currData, $data);
        if($newData != 0 || $currData === 0) break;
      }
      $request->session()->put('lastUpdated', $data);
      return response()->json($result);

    }
}
