<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/user/{name}', [UserController::class, 'show']);
Route::view('/about', 'pages.about')->name('about');

Route::redirect('/log-in', '/login');

Route::middleware('auth')->group(function () {
    Route::prefix('/app')->group(function () {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::resource('/tasks', TaskController::class);
    });
    Route::prefix('/admin')->middleware('is_admin')->group(function () {
        Route::get('/dashboard', Admin\DashboardController::class);
        Route::get('/stats', Admin\StatsController::class);
    });
});

require __DIR__.'/auth.php';
