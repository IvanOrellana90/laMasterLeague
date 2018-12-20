<?php

namespace App\Http\Controllers;

use App\Faq;

class FaqController extends Controller
{
    public function faqs()
    {
        $faqs = Faq::orderBy('category')
            ->get();

        $categories = Faq::groupBy('category')
            ->groupBy('category')
            ->select('category')
            ->get();

        return view('user.faq', [
            'faqs' => $faqs,
            'categories' => $categories
        ]);
    }
}