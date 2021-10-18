<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

Route::get('/user/{name}', [\App\Http\Controllers\UserController::class, 'show']);

Route::view('/about', 'pages.about')->name('about');

Route::redirect('log-in', 'login');

Route::middleware('auth')->group(function () {
    Route::prefix('app')->group(function () {
        Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)->name('dashboard');
        Route::resource('/tasks', \App\Http\Controllers\TaskController::class);
    });
    Route::prefix('admin')->group(function () {
        Route::middleware('is_admin')->group(function () {
            Route::get('/dashboard', \App\Http\Controllers\Admin\DashboardController::class);
            Route::get('/stats', \App\Http\Controllers\Admin\StatsController::class);
        });
    });
});

require __DIR__.'/auth.php';
