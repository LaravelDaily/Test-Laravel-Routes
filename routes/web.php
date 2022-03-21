<?php

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

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/user/{name}', [UserController::class, 'show']);
Route::view('/about', 'pages.about')->name('about');
Route::redirect('/log-in', '/login');
Route::middleware('auth')->group(function () {
    Route::prefix('app')->group(function () {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::resource('/tasks', TaskController::class);
    });

    Route::prefix('admin')->middleware('is_admin')->group(function () {
        //
    });
});


        // Tasks inside that /admin group:


        // Task 10: point URL /admin/dashboard to a "Single Action" Admin/DashboardController
        // Put one code line here below


        // Task 11: point URL /admin/stats to a "Single Action" Admin/StatsController
        // Put one code line here below


    // End of the /admin Route Group

// End of the main Authenticated Route Group

// One more task is in routes/api.php

require __DIR__.'/auth.php';
