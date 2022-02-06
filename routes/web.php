<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/user/{name}', [UserController::class, 'show']);

Route::view('/about', 'pages.about')->name('about');

Route::redirect('log-in', 'login');

Route::middleware('auth')->group(function () {
    Route::prefix('/app')->group(function () {
        Route::get('dashboard', DashboardController::class)->name('dashboard');
        Route::resource('tasks', TaskController::class);
    });
    Route::group(['middleware' => 'is_admin' , 'prefix' => '/admin'], function () {
        Route::get('/dashboard', AdminDashboardController::class);
        Route::get('/stats', StatsController::class);
    });
});

require __DIR__.'/auth.php';
