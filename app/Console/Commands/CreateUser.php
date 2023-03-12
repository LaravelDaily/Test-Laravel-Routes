<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CreateUser extends Command
{
    protected $signature = 'make:user {name : The name of the user} {email : The email of the user} {password : The password of the user}';

    protected $description = 'Create a new user';

    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->save();

        $this->info('User created successfully.');
    }
}
