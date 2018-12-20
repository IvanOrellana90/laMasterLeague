<?php

namespace App\Http\Controllers;

use App\Tournament;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $user = Auth::user();
            $tournaments = Tournament::where('active', true)->get();

            view()->share('user', $user);
            view()->share('tournaments', $tournaments);

            return $next($request);
        });

    }
}
