<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\StatsController;
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

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::get('/user/{name}', [UserController::class, 'show'])->name('user.show');

Route::view('/about', 'pages.about')->name('about');

Route::get('log-in', function () {
    return redirect('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'app'], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('tasks', TaskController::class);
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function () {
        Route::view('dashboard', 'admin.dashboard')->name('admin.dashboard');
        Route::view('stats', 'admin.stats')->name('admin.stats');
    });
});

require __DIR__.'/auth.php';
