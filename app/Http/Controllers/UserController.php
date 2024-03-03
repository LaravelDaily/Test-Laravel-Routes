<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function show(User $name)
    {
        if (!User::exists($user->name)) {
            return view('users.notfound');
        }

        return view('users.show', ['user'=>$user]));
    }
}
