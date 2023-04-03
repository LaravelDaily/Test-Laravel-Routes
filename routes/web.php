<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Admin\DashboardController as DashController;
use App\Http\Controllers\Admin\StatsController;


Route::get("/", [HomeController::class,"index"]);

Route::get('/user/{name}', [UserController::class,'show']);

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::redirect('/login', '/log-in');

Route::middleware(['auth'])->group(function () {
    Route::prefix('app')->group(function () {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::resource('tasks', TaskController::class);
    });
    Route::middleware(['is_admin'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', DashController::class);
            Route::get('/stats', StatsController::class);
        });
    });
});

// One more task is in routes/api.php

require __DIR__.'/auth.php';
