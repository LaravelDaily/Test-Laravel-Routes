<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function show($name)
    {

        $user = User::where('name', $name)->first();
        if (!$user) {
            return view('users.notfound');
        }

        return view('users.show', compact('user'));
    }


     public function redirectLogin()
     {
        return Redirect::route('login');
     }
}
