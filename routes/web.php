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
Route::get('/', [HomeController::class, 'index']);


// Task 2: point the GET URL "/user/[name]" to the UserController method "show"
Route::get('/user/{name}', [UserController::class, 'show']);


// Task 3: point the GET URL "/about" to the view resources/views/pages/about.blade.php
// Also, assign the route name "about"
Route::view('/about', 'pages.about')->name('about');


// Task 4: redirect the GET URL "log-in" to a URL "login"
Route::redirect('/log-in', '/login');


// Task 5: group the following routes under middleware "auth"
Route::middleware(['auth'])->group(function () {

    // Task 6: create another group for routes with prefix "app"
    Route::prefix('app')->group(function () {

        // Task 7: point URL /app/dashboard to a Single Action DashboardController
        // Assign the route name "dashboard"
        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        // Task 8: Manage tasks with 7 resource routes for TaskController
        Route::resource('tasks', TaskController::class);
    });

    // Task 9: create another group for routes with URL prefix "admin" and middleware "is_admin"
    Route::prefix('admin')->middleware(['is_admin'])->group(function () {

        // Task 10: point URL /admin/dashboard to a Single Action Admin/DashboardController
        Route::get('/dashboard', AdminDashboardController::class);

        // Task 11: point URL /admin/stats to a Single Action Admin/StatsController
        Route::get('/stats', AdminStatsController::class);
    });
});

require __DIR__.'/auth.php';
