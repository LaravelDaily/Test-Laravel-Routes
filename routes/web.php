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
Route::get('/', [HomeController::class, 'index']);
Route::get('/user/{name}', [UserController::class, 'show']);
Route::get('/about', function (Request $request) {
    return view('pages/about');
})->name('about');
Route::redirect('/log-in', '/login');

Route::middleware(['auth'])->group(function () {
    Route::prefix('app')->group(function () {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::resource('tasks', TaskController::class);
    });

    Route::middleware(['is_admin'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', \App\Http\Controllers\Admin\DashboardController::class);
            Route::get("/stats", StatsController::class);
        });
    });
});

require __DIR__.'/auth.php';
