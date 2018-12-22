<?php

namespace App\Http\Controllers;

use App\Legend;

class LegendController extends Controller
{
    public function legends()
    {
        $legends = Legend::all();

        return view('legend.legends', [
            'legends' => $legends
        ]);
    }
}