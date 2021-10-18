<?php

namespace App\Http\Controllers;

use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $pageTitle = 'Homepage';

        return view('welcome', compact('pageTitle'));
    }

    public function show($name)
    {
        $user = User::whereName($name)->first();

        if(!$user) return view('users.notfound');

        return view('users.show', compact('user'));
    }
}
