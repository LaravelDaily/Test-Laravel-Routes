<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\StatsController as AdminStatsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Task 1: point the main "/" URL to the HomeController method "index"
// Put one code line here below


// Task 2: point the GET URL "/user/[name]" to the UserController method "show"
// It doesn't use Route Model Binding, it expects $name as a parameter
// Put one code line here below


// Task 3: point the GET URL "/about" to the view
// resources/views/pages/about.blade.php - without any controller
// Also, assign the route name "about"
// Put one code line here below


// Task 4: redirect the GET URL "log-in" to a URL "login"
// Put one code line here below


// Task 5: group the following route sentences below in Route::group()
// Assign middleware "auth"
// Put one Route Group code line here below

    // Tasks inside that Authenticated group:

    // Task 6: /app group within a group
    // Add another group for routes with prefix "app"
    // Put one Route Group code line here below

        // Tasks inside that /app group:


        // Task 7: point URL /app/dashboard to a "Single Action" DashboardController
        // Assign the route name "dashboard"
        // Put one Route Group code line here below


        // Task 8: Manage tasks with URL /app/tasks/***.
        // Add ONE line to assign 7 resource routes to TaskController
        // Put one code line here below

    // End of the /app Route Group


    // Task 9: /admin group within a group
    // Add a group for routes with URL prefix "admin"
    // Assign middleware called "is_admin" to them
    // Put one Route Group code line here below


        // Tasks inside that /admin group:


        // Task 10: point URL /admin/dashboard to a "Single Action" Admin/DashboardController
        // Put one code line here below


        // Task 11: point URL /admin/stats to a "Single Action" Admin/StatsController
        // Put one code line here below


    // End of the /admin Route Group

// End of the main Authenticated Route Group

// One more task is in routes/api.php
// Task 1
Route::get('/', 'HomeController@index');

// Task 2
Route::get('/user/{name}', 'UserController@show');

// Task 3
Route::view('/about', 'pages.about')->name('about');
//task 4 
Route::redirect('/log-in', '/login', 301);

// Task 5: Authenticated Route Group
Route::group(['middleware' => 'auth'], function () {

    // Task 6: /app group within a group
    Route::group(['prefix' => 'app'], function () {

        // Tasks inside that /app group:

        // Task 7: /app/dashboard route
        // Task 7: /app/dashboard route
        Route::get('/app/dashboard', 'DashboardController')->name('dashboard');

// Task 8: /app/tasks route
        Route::resource('/app/tasks', 'TaskController')->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);


    }); // End of the /app Route Group

    // Task 9: /admin group within a group
    Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function () {

        // Tasks inside that /admin group:

        // Task 10: /admin/dashboard route
        Route::get('/dashboard', [AdminDashboardController::class, '__invoke']);

        // Task 11: /admin/stats route
        Route::get('/stats', [AdminStatsController::class, '__invoke']);

    }); // End of the /admin Route Group

}); // End of the main Authenticated Route Group

require __DIR__.'/auth.php';
