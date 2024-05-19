<?php

namespace App\Providers;

<<<<<<< HEAD

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\PermissionServiceProvider;
=======
use Illuminate\Support\ServiceProvider;
>>>>>>> origin/main

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
<<<<<<< HEAD
     */
    public function register(): void
    {
        $this->app->register(PermissionServiceProvider::class);
=======
     *
     * @return void
     */
    public function register()
    {
        //
>>>>>>> origin/main
    }

    /**
     * Bootstrap any application services.
<<<<<<< HEAD
     */
    public function boot(): void
    {

=======
     *
     * @return void
     */
    public function boot()
    {
        //
>>>>>>> origin/main
    }
}
