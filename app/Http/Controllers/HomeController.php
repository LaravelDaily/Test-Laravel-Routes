<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __invoke()
    {
        $pageTitle = 'Homepage';

        return view('welcome', compact('pageTitle'));
    }
}
