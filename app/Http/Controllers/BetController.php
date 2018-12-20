<?php

namespace App\Http\Controllers;

use App\Achievements\UserMadeABet;
use App\Bet;
use App\Match;
use App\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BetController extends Controller
{
    public function bet($id)
    {
        $matches = Match::where('tournament_id', $id)->get();

        return view('bet.bet', [
            'matches' => $matches
        ]);
    }

    public function bets()
    {
        $matches = Match::where('finished', false)
            ->orderBy('finished', 'asc')
            ->orderBy('date', 'asc')
            ->get();

        $tournaments = Tournament::all();

        return view('bet.bets', [
            'matches' => $matches,
            'tournaments' => $tournaments
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'match_id' => 'required|exists:matches,id',
            'home_score' => 'required|numeric|digits_between:1,2',
            'away_score' => 'required|numeric|digits_between:1,2'
        ]);

        $match_id = $request->match_id;
        $match = Match::where('id',$match_id)->first();

        $mensaje = "OPS! Ocurrio un problema!";
        $class = "error";

        if(dateBiggerNow($match->date)) {

            $bet = Bet::where('match_id', $match->id)->where('user_id', Auth::id())->first();

            if($bet === null)
            {
                $bet = new Bet();
                $bet->user_id = Auth::id();
                $bet->match_id = $match->id;
                $bet->home_score = $request->home_score;
                $bet->away_score = $request->away_score;
            }
            else
            {
                $bet->user_id = Auth::id();
                $bet->match_id = $match->id;
                $bet->home_score = $request->home_score;
                $bet->away_score = $request->away_score;
            }

            if($bet->save()) {
                $mensaje = "Apuesta realizada con exito!";
                $class = "success";

                Auth::user()->unlock(new UserMadeABet());
            }
        } else {
            $mensaje = "OPS! La hora de tu predicción paso su limite!";
            $class = "error";
        }

        return redirect()->to(app('url')->previous()."#".$match_id)->with(['message' => $mensaje, 'class' => $class]);
    }
}