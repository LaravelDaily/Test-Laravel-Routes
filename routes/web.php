<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');

Route::get('user/{name}', 'UserController@show');

Route::view('/about', 'pages.about')->name('about');

Route::redirect('/log-in', '/login', 301);

Route::middleware(['auth'])->group(function () {

    Route::prefix('app')->group(function () {

        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        Route::resource('tasks', TaskController::class);
    });

    Route::middleware(['is_admin'])->prefix('admin')->namespace('Admin')->group(function () {

        Route::get('/dashboard', DashboardController::class);

        Route::get('/stats', StatsController::class);
        
    });
    
});

require __DIR__.'/auth.php';
