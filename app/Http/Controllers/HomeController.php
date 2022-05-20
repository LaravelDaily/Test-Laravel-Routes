<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $pageTitle = 'Homepage';

        return view('welcome', compact('pageTitle'));
    }

    public function create() {
        $pageTitle = 'Create';
        return view('create', compact('pageTitle'));
    }
}
