<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $pageTitle = 'Homepage';

        return view('welcome', compact('pageTitle'));
    }
}
