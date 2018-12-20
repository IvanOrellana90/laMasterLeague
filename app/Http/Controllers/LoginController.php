<?php

namespace App\Http\Controllers;

use App\Match;
use App\Topic;
use App\Tournament;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.login');
    }

    public function home()
    {
        $tournaments = Tournament::all();

        $users = User::where('admin',false)
            ->get();

        $userYeta = User::join('bets','bets.user_id','=','users.id')
            ->join('matches','matches.id','=','bets.match_id')
            ->where('matches.finished', true)
            ->get();

        $matches = Match::orderBy('finished', 'asc')
            ->orderBy('date', 'asc')
            ->take(5)
            ->get();

        $topics = Topic::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $lastMatches = Match::orderBy('finished', 'desc')
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();

        foreach ($users as $user) {
            $user->points = getUserPoints($user->id);
            $user->efectividad = getUserEfectividad($user->id);
        }

        return view('user.home', [
            'tournaments' => $tournaments,
            'users' => $users,
            'matches' => $matches,
            'lastMatches' => $lastMatches,
            'topics' => $topics
        ]);
    }

    public function register()
    {
        return view('login.register');
    }

    public function validateLogin(Request $request)
    {
        $email = $request['email'];
        $password = $request['password'];

        $mensaje = "Ups! Correo o contraseña incorrectos.";
        $class = "error";

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->route('home');
        }

        return redirect()->route('login')->with(['message' => $mensaje, 'class' => $class]);
    }

    public function logout()
    {
        Auth::logout();
        return view('login.login');
    }
}