<?php

use Carbon\Carbon;
use App\Bet;
use App\User;
use App\Group;
use App\Match;
use App\Like;
use Illuminate\Support\Facades\DB;

function dateBiggerNow($date)
{
    $dateCarbon = Carbon::createFromFormat('Y-m-d H:i:s', $date, 'America/Santiago');
    $now = Carbon::now('America/Santiago');

    if($dateCarbon->gt($now))
        return true;
    else
        return false;
}

function colorCategory($category)
{
    if($category == 'Bienvenidos')
        return '#17a2b8';
    if($category == 'Noticias')
        return '#ffc107';
    if($category == 'General')
        return '#28a745';
    if($category == 'Problemas')
        return '#dc3545';
    if($category == 'Puntos')
        return '#526069';
    if($category == 'Apuestas')
        return '#007bff';
    if($category == 'Resultados')
        return '#eb6709';
}

function getPuntos($match_id)
{
    $pts = Bet::where('match_id', $match_id)->where('user_id', Auth::id())->first();

    if($pts != null)
        return $pts->points;
    else
        return "";
}

function diffDays($date)
{
    $dateCarbon = Carbon::createFromFormat('Y-m-d H:i:s', $date, 'America/Santiago');
    $now = Carbon::now('America/Santiago');

    return $now->diffInDays($dateCarbon);
}

function getUserTournamentEfectividad($tournament_id, $user_id)
{
    $user = User::where('users.id', $user_id)
        ->join('bets','bets.user_id','=','users.id')
        ->join('matches','matches.id','=','bets.match_id')
        ->where('matches.tournament_id', $tournament_id)
        ->where('matches.finished', true)
        ->select(DB::raw('SUM(bets.points) as points'),DB::raw('COUNT(bets.points) as total'))
        ->get();

    if($user[0]->total == 0)
    {
        return 0;
    }

    return  round(($user[0]->points/($user[0]->total*5))*100);

}

function getUserEfectividad($user_id)
{
    $user = User::where('users.id', $user_id)
        ->join('bets','bets.user_id','=','users.id')
        ->join('matches','matches.id','=','bets.match_id')
        ->where('matches.finished', true)
        ->select(DB::raw('SUM(bets.points) as points'),DB::raw('COUNT(bets.points) as total'))
        ->first();

    if($user->total == 0)
    {
        return 0;
    }

    return  round(($user->points/($user->total*5))*100);

}

function getUserTournamentPoints($tournament_id, $user_id)
{
    $user = User::where('users.id', $user_id)
        ->join('bets','bets.user_id','=','users.id')
        ->join('matches','matches.id','=','bets.match_id')
        ->where('admin', false)
        ->groupBy('users.id','users.name','users.email','users.password','users.avatar_id','users.admin','users.remember_token','users.updated_at','users.created_at','tournament_id')
        ->where('matches.tournament_id', $tournament_id)
        ->where('matches.finished', true)
        ->select('users.*','tournament_id', DB::raw('SUM(bets.points) as points'))
        ->first();

    if($user['points'] == "")
    {
        return 0;
    }

    return $user['points'];
}

function getUserPoints($user_id)
{
    $points = Bet::where('user_id', $user_id)
        ->select(DB::raw('SUM(points) as total_points'))
        ->first();

    if($points->total_points == null)
        $points->total_points = 0;

    return $points->total_points;
}

function countUsersByGroup($group_id)
{
    $numeroUsuarios = Group::where('groups.id', $group_id)
        ->join('group_user','group_user.group_id','=','groups.id')
        ->where('group_user.active',1)
        ->count();

    return $numeroUsuarios;
}

function getUserLevel($user_id)
{
    $points = Bet::where('user_id', $user_id)
        ->select(DB::raw('SUM(points) as total_points'))
        ->first();

    if($points->total_points == null)
        $points->total_points = 0;

    $levels = DB::table('levels')
        ->orderBy('level', 'desc')
        ->get();

    foreach ($levels as $level)
    {
        if($points->total_points >= $level->points)
            return $level->level;
    }
}

function getUserNextLevel($user_id)
{
    $level = getUserLevel($user_id);
    $nextLevel = $level +1;
    $points = getUserPoints($user_id);

    $levelPoints = DB::table('levels')->where('level', $level)->first()->points;
    $nextLevelPoints = DB::table('levels')->where('level', $nextLevel)->first()->points;

    return round(($points-$levelPoints)/($nextLevelPoints-$levelPoints)*100);
}

function getTeamTournamentEfectividad($tournament_id, $team_id)
{
    $matches = Match::where('tournament_id',$tournament_id)
        ->where('finished',true)
        ->where(function ($query) use ($team_id) {
            $query->where('home_team',$team_id)
                  ->orWhere('away_team',$team_id);
        })
        ->get();

    $points = 0;

    if($matches->count() == 0)
        return 0;

    foreach ($matches->where('finished',true) as $match) {
        if($match->home_team == $team_id) {
            if($match->home_score > $match->away_score)
                $points = $points + 3;
            elseif ($match->home_score == $match->away_score)
                $points = $points + 1;
        } else {
            if($match->away_score > $match->home_score)
                $points = $points + 3;
            elseif ($match->home_score == $match->away_score)
                $points = $points + 1;
        }
    }

    return round($points/($matches->count()*3)*100);
}

function getTeamTournamentMatches($tournament_id,$team_id)
{
    $matches = Match::where('tournament_id',$tournament_id)
        ->where(function ($query) use ($team_id) {
            $query->where('home_team',$team_id)
                ->orWhere('away_team',$team_id);
        })
        ->get();

    return $matches->where('finished',true)->count();
}

function getTeamTournamentPoints($tournament_id, $team_id)
{
    $matches = Match::where('tournament_id',$tournament_id)
        ->where('home_team',$team_id)
        ->orWhere('away_team',$team_id)
        ->get();

    $points = 0;

    foreach ($matches->where('finished',true) as $match) {
        if($match->home_team == $team_id) {
            if($match->home_score > $match->away_score)
                $points = $points + 3;
            elseif ($match->home_score == $match->away_score)
                $points = $points + 1;
        } else {
            if($match->away_score > $match->home_score)
                $points = $points + 3;
            elseif ($match->home_score == $match->away_score)
                $points = $points + 1;
        }
    }

    return $points;
}

function getGrupoUserLugar($group_id,$user_id)
{
    $group = Group::where('id', $group_id)->first();
    $count = 1;

    foreach ($group->users as $user)
    {
        $user->points = getUserTournamentPoints($group->tournament->id, $user->id);
    }

    foreach ($group->users->sortByDesc('points') as $user)
    {
        if($user->pivot->active) {
            if($user->id == $user_id)
                return $count;
            else
                $count++;
        }
    }

    return 0;
}

function countBetMatchFinished($user_id)
{
    $bet = User::where('users.id', $user_id)
        ->join('bets','bets.user_id','=','users.id')
        ->join('matches','matches.id','=','bets.match_id')
        ->where('matches.finished', true)
        ->get();

    return $bet->count();
}

function removeUnclosedTags($text)
{
    $doc = new DOMDocument();
    $doc->encoding = 'utf-8';
    $doc->loadHTML(utf8_decode($text));
    $text = $doc->saveHTML();

    return $text;
}

function getPercentageHome($match_id, $total)
{
    if($total == 0)
        return "0%";

    $res = Bet::where('match_id', $match_id)
        ->whereColumn('home_score', '>' ,'away_score')
        ->count();

    return round($res/$total*100)."%";
}

function getPercentageDraw($match_id, $total)
{
    if($total == 0)
        return "0%";

    $res = Bet::where('match_id', $match_id)
        ->whereColumn('home_score', '=', 'away_score')
        ->get();

    return round($res->count()/$total*100)."%";
}

function getPercentageAway($match_id, $total)
{
    if($total == 0)
        return "0%";

    $res = Bet::where('match_id', $match_id)
        ->whereColumn('home_score', '<' ,'away_score')
        ->count();

    return round($res/$total*100)."%";
}

function getMediaGolesLocal($match_id, $total)
{
    if($total == 0)
        return "0";

    $res = Bet::where('match_id', $match_id)
        ->sum('home_score');

    return round($res/$total,1);
}

function getMediaGolesVisita($match_id, $total)
{
    if($total == 0)
        return "0";

    $res = Bet::where('match_id', $match_id)
        ->sum('away_score');

    return round($res/$total,1);
}

function getNumberHome($match_id)
{
    $res = Bet::where('match_id', $match_id)
    ->whereColumn('home_score', '>' ,'away_score')
    ->count();

    return $res;
}

function getNumberDraw($match_id)
{
    $res = Bet::where('match_id', $match_id)
        ->whereColumn('home_score', '=' ,'away_score')
        ->count();

    return $res;
}

function getNumberAway($match_id)
{
    $res = Bet::where('match_id', $match_id)
        ->whereColumn('home_score', '<' ,'away_score')
        ->count();

    return $res;
}

function getPuntosPromedio($match_id, $total)
{
    if($total == 0)
        return "0";

    $res = Bet::where('match_id', $match_id)
        ->sum('points');

    return round($res/$total,1);
}

function countLikes($topic, $topic_id) {

    $res = Like::where('topic', $topic)
        ->where('topic_id', $topic_id)
        ->count();

    return $res;

}

function doYouLike($topic, $topic_id) {

    $res = Like::where('user_id', Auth::id())
        ->where('topic', $topic)
        ->where('topic_id', $topic_id)
        ->first();

    if($res != null)
        return true;
    else
        return  false;
}