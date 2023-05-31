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

    public function show()
    {
        $name = request('name');
        $view = 'show';

        $user = User::where('name', $name)
            ->firstOr(function () use (&$view){
                $view = 'notfound';
            });

        return view('users.' . $view, [
            'user' => $user
        ]);
    }
}
