<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('users/{name}', [UserController::class, 'show']);

Route::view('/about', 'resources/views/pages/about.blade.php')->name("about");

Route::redirect('log-in', 'login');

Route::middleware(['auth'])->group(function () {

    Route::prefix('/app')->group(function(){

        Route::post('/dashboard', DashboardController::class)->name('dashboard');

        Route::resource('/tasks', TaskController::class);
    });
    Route::prefix('admin')->middleware(['is_admin'])->group(function () {
        
        Route::post('/dashboard',AdminDashboardController::class);
        Route::post('/stats',StatsController::class);
    });

});
require __DIR__.'/auth.php';
