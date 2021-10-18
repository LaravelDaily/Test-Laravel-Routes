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

// Task 1: point the main "/" URL to the HomeController method "index"
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);


// Task 2: point the GET URL "/user/[name]" to the UserController method "show"
Route::get('/user/{name}', [App\Http\Controllers\UserController::class, 'show']);


// Task 3: point the GET URL "/about" to the view
Route::view('/about', 'pages/about')->name('about');


// Task 4: redirect the GET URL "log-in" to a URL "login"
Route::redirect('/log-in', '/login');


// Task 5: group the following route sentences below in Route::group()
Route::middleware(['auth'])->group(function () {
    // Task 6: /app group within a group
    Route::prefix('app')->group(function () {
        // Task 7: point URL /app/dashboard to a "Single Action" DashboardController
        Route::get('dashboard', [App\Http\Controllers\DashboardController::class])->name('dashboard');
        // Task 8: Manage tasks with URL /app/tasks/***.
        Route::resource('tasks', App\Http\Controllers\TaskController::class);
    });


    // Task 9: /admin group within a group
    Route::prefix('admin')->group(function () {
        // Task 10: point URL /admin/dashboard to a "Single Action" Admin/DashboardController
        Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class])->name('admin.dashboard');
        // Task 11: point URL /admin/stats to a "Single Action" Admin/StatsController
        Route::resource('stats', App\Http\Controllers\Admin\StatsController::class);
    });
});

// One more task is in routes/api.php

require __DIR__.'/auth.php';
