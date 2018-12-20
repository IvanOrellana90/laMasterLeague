<?php

namespace App\Http\Controllers;

use App\Team;
use App\Tournament;
use App\Bet;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TournamentController extends Controller
{
    public function tournament($id)
    {
        $tournament = Tournament::where('id', $id)->first();

        $teams = Team::join('matches', function($join){
                    $join->on('teams.id','=','matches.home_team'); // i want to join the users table with either of these columns
                    $join->orOn('teams.id','=','matches.away_team');
                })
                ->where('matches.tournament_id', $id)
                ->groupBy('teams.id','teams.name','teams.logo','teams.flag','teams.stadium_id','teams.coach','teams.updated_at','teams.created_at')
                ->select('teams.*')
                ->get();

        $users = User::join('bets','bets.user_id','=','users.id')
            ->join('matches','matches.id','=','bets.match_id')
            ->where('admin', false)
            ->groupBy('users.id','users.name','users.email','users.password','users.avatar_id','users.admin','users.remember_token','users.updated_at','users.created_at','tournament_id')
            ->where('matches.tournament_id', $id)
            ->where('matches.finished', true)
            ->select('users.*','tournament_id', DB::raw('SUM(bets.points) as points'))
            ->get();

        return view('tournament.tournament', [
            'tournament' => $tournament,
            'teams' => $teams,
            'users' => $users
        ]);
    }
}