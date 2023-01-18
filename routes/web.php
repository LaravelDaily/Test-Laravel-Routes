<?php

use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\DashboardController as dashboard;
use App\Http\Controllers\Admin\DashboardController as adminDashboard;
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

Route::get('log-in', function () {
    return redirect()->to('login');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('app')->group(function () {
        Route::get('/dashboard', [dashboard::class, 'index']);
        Route::resource('/tasks', TaskController::class);
    });

    Route::prefix('admin')->middleware(['is_admin'])->group(function () {
        Route::get('/dashboard', [adminDashboard::class, 'index']);
        Route::resource('/stats', StatsController::class);
    });
});


require __DIR__.'/auth.php';
