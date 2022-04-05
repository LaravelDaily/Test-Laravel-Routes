<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::firstWhere('name', $name);

        if (! $user) return view('users.notfound');

        return view('users.show', compact('user'));
    }
}
