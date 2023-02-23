<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
          \App\Models\User::factory()->create([
                'name' => 'sami',
                'email' => 'sami@sami.com',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'password' => bcrypt('password'),
                'is_admin' => false,
            ]);
    }
          
}
