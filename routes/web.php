<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Api\V1\TaskController as V1TaskController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController as TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

// Task 1: point the main "/" URL to the HomeController method "index"
Route::get('/', [HomeController::class, 'index']);

// Task 2: point the GET URL "/user/[name]" to the UserController method "show"
Route::get('user/{name}', [UserController::class, 'show']);

// Task 3: point the GET URL "/about" to the view resources/views/pages/about.blade.php - without any controller
Route::view('/about', 'pages.about')->name('about');

// Task 4: redirect the GET URL "log-in" to a URL "login"
Route::redirect('log-in', 'login', 302);

// Task 5: group the following route sentences below in Route::group()
Route::group(['middleware' => 'auth'], function () {
    Route::prefix('app')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('tasks', TaskController::class);
    });
});

// Task 6: /app group within a group
Route::prefix('app')->middleware('auth')->group(function () {
    // Task 7: point URL /app/dashboard to a "Single Action" DashboardController
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Task 8: Manage tasks with URL /app/tasks/***
    Route::resource('tasks', TaskController::class);
});

// Task 9: /admin group within a group
Route::prefix('admin')->middleware('is_admin')->group(function () {
    // Task 10: point URL /admin/dashboard to a "Single Action" Admin/DashboardController
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Task 11: point URL /admin/stats to a "Single Action" Admin/StatsController
    Route::get('stats', [StatsController::class, 'index'])->name('admin.stats');
});

// End of the main Authenticated Route Group

// One more task is in routes/api.php
 Route::prefix('api/v1')->group(function () {
    Route::resource('tasks', V1TaskController::class);
 });

require __DIR__ . '/auth.php';
