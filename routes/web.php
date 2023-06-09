<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\StatsController as AdminStatsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



// Task 1: point the main "/" URL to the HomeController method "index"
// Put one code line here below

Route::get('/', [HomeController::class, 'index']);

// Task 2: point the GET URL "/user/[name]" to the UserController method "show"
// It doesn't use Route Model Binding, it expects $name as a parameter
// Put one code line here below

Route::get('/user/{name}',[UserController::class, 'show']);

// Task 3: point the GET URL "/about" to the view
// resources/views/pages/about.blade.php - without any controller
// Also, assign the route name "about"
// Put one code line here below

Route::view('about', 'pages.about')->name('about');

// Task 4: redirect the GET URL "log-in" to a URL "login"
// Put one code line here below

Route::redirect('/log-in', '/login');

// Task 5: group the following route sentences below in Route::group()
// Assign middleware "auth"
// Put one Route Group code line here below
Route::middleware(['auth:sanctum'])->group(function () {

    // Tasks inside that Authenticated group:

    // Task 6: /app group within a group
    // Add another group for routes with prefix "app"
    // Put one Route Group code line here below

    Route::prefix('app')->group(function () {
        // Tasks inside that /app group:


        // Task 7: point URL /app/dashboard to a "Single Action" DashboardController
        // Assign the route name "dashboard"
        // Put one Route Group code line here below

        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        // Task 8: Manage tasks with URL /app/tasks/***.
        // Add ONE line to assign 7 resource routes to TaskController
        // Put one code line here below

        Route::resource('/tasks', TaskController::class);
    });
    // End of the /app Route Group


        // Tasks inside that /admin group:

    Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function () {
        Route::get('/dashboard', AdminDashboardController::class);
        Route::get('/stats', AdminStatsController::class);
    });
});
