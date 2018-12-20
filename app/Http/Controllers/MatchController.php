<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Match;
use App\Team;
use App\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class MatchController extends Controller
{
    public function adminMatches()
    {
        $matches = Match::orderBy('finished', 'asc')
            ->orderBy('date', 'asc')
            ->get();

        $tournaments = Tournament::all();

        return view('admin.matches', [
            'matches' => $matches,
            'tournaments' => $tournaments
        ]);
    }

    public function adminMatchFinished(Request $request)
    {
        $this->validate($request, [
            'match_id' => 'required|exists:matches,id',
            'home_score' => 'required|numeric|digits_between:1,2',
            'away_score' => 'required|numeric|digits_between:1,2'
        ]);

        $match_id = $request->match_id;
        $count = 0;
        $countSuccess = 0;

        $mensaje = "OPS! Ocurrio un problema!";
        $class = "error";

        if( Auth::user()->admin == 0 )
            return redirect()->to(app('url')->previous()."#".$match_id)->with(['message' => "No tienes los permisos suficientes para realizar esta acción!", 'class' => $class]);

        $match = Match::where('id', $match_id)->first();

        $match->home_score = $request['home_score'];
        $match->away_score = $request['away_score'];
        $match->finished = true;


        if($match->save())
        {
            $bets = Bet::where('match_id', $match_id)->get();

            foreach ($bets as $bet)
            {
                $bet->points = $this->calculatePoints($bet, $match);
                $count ++;

                if($bet->save())
                    $countSuccess ++;
            }

            $mensaje = "Partido actualizado (".$match->id.") y ".$countSuccess." de ".$count." apuestas revisadas";
            $class = "success";
        }

        return redirect()->back()->with(['message' => $mensaje, 'class' => $class]);
    }

    public function calculatePoints($bet, $match)
    {
        if ($bet->away_score == $match->away_score && $bet->home_score == $match->home_score)
        {
            return 5; // Ganador y resultados iguales
        }
        elseif ($bet->home_score > $bet->away_score && $match->home_score > $match->away_score)
        {
            if ($bet->away_score == $match->away_score || $bet->home_score == $match->home_score)
            {
                return 4; // Ganador y un resultado igual
            }
            else
            {
                return 3; // Ganador
            }
        }
        elseif ($bet->away_score > $bet->home_score && $match->away_score > $match->home_score)
        {
            if ($bet->away_score == $match->away_score || $bet->home_score == $match->home_score)
            {
                return 4; // Ganador y un resultado igual
            }
            else
            {
                return 3; // Ganador
            }
        }
        elseif ($bet->home_score == $bet->away_score && $match->home_score == $match->away_score)
        {
            return 3; // Ganador (Empate)
        }
        elseif ($bet->away_score == $match->away_score || $bet->home_score == $match->home_score)
        {
            return 1; // Un resultado
        }
        else
        {
            return 0; // Nada
        }

    }
}