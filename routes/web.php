<?php

use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/user/{name}', [UserController::class, 'show']);

Route::view('/about', 'pages.about')->name('about');

Route::redirect('/log-in', 'login'); // Error

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'app'], function () {
        Route::get('/dashboard',DashboardController::class)->name('dashboard');
        Route::resource('tasks',TaskController::class);
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function () {
        Route::get('/dashboard', \App\Http\Controllers\Admin\DashboardController::class);
        Route::get('/stats',StatsController::class);
    });

});

require __DIR__.'/auth.php';
