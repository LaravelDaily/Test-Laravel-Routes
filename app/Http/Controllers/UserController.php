<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function show($name)
    {
        $user = User::query()->where('name', $name)->first();
        if (!$user) {
            return view('users.notfound');
        }

        return view('users.show', compact('user'));
    }
}
