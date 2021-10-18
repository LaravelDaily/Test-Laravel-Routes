<?php

use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Task 1: point the main "/" URL to the HomeController method "index"
Route::get('/', [HomeController::class, 'index'])->name('landing.index');


// Task 2: point the GET URL "/user/[name]" to the UserController method "show"
// It doesn't use Route Model Binding, it expects $name as a parameter
Route::get('/user/{name}', [UserController::class, 'show'])->name('landing.user.show');


// Task 3: point the GET URL "/about" to the view
// resources/views/pages/about.blade.php - without any controller
// Also, assign the route name "about"
// Put one code line here below
Route::view('about', 'pages.about')->name('about');


// Task 4: redirect the GET URL "log-in" to a URL "login"
// Put one code line here below
Route::get('/log-in', function () {
    return redirect()->route('login');
})->name('redirect.login');


// Task 5: group the following route sentences below in Route::group()
// Assign middleware "auth"
Route::group(['middleware' => 'auth'], function () {

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
        Route::resource('tasks', 'App\Http\Controllers\TaskController');
    });
    // End of the /app Route Group


    // Task 9: /admin group within a group
    // Add a group for routes with URL prefix "admin"
    // Assign middleware called "is_admin" to them
    // Put one Route Group code line here below
    Route::group(['prefix' => 'admin', 'middleware' => 'is_admin', 'as' => 'admin.'], function () {
        // Confused to keep it within auth::middleware group or app::prefix Group.

        // Task 10: point URL /admin/dashboard to a "Single Action" Admin/DashboardController
        // Put one code line here below
        Route::get('/dashboard', \App\Http\Controllers\Admin\DashboardController::class)->name('dashboard');

        // Task 11: point URL /admin/stats to a "Single Action" Admin/StatsController
        // Put one code line here below
        Route::get('/stats', StatsController::class)->name('stats.index');
    });
    // End of the /admin Route Group

});
// End of the main Authenticated Route Group

// One more task is in routes/api.php

require __DIR__ . '/auth.php';
