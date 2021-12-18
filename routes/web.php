<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Api\V1\TaskController as TaskApiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/user/{name}', [UserController::class, 'show']);
Route::view('/about', 'pages.about')->name('about');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'app'], function () {
        Route::get('dashboard', DashboardController::class)->name('dashboard');
        Route::resource('tasks', TaskController::class);
    });

    Route::group(['middleware' => 'is_admin', 'prefix' => 'admin', 'ad' => 'admin'], function () {
        Route::get('dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('stats', StatsController::class)->name('stats');
    });

    Route::group(['prefix' => 'api/v1', 'as' => 'api.'], function () {
        Route::resource('tasks', TaskApiController::class);
    });
});


require __DIR__ . '/auth.php';
