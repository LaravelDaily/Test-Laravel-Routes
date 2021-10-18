<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    HomeController,
    TaskController,
    UserController
};

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
Route::get('/', [HomeController::class, 'index']);


// Task 2: point the GET URL "/user/[name]" to the UserController method "show"
Route::get('/user/{name}', [UserController::class, 'show'])->name('user.show');


// Task 3: point the GET URL "/about" to the view
Route::view('/about', 'pages.about')->name('about');


// Task 4: redirect the GET URL "log-in" to a URL "login"
Route::redirect('log-in', 'login', 301);


// Task 5: group the following route sentences below in Route::group()
Route::group(['middleware' => 'auth'], function () {

    // Task 6: /app group within a group
    Route::group(['prefix' => 'app'], function () {

        // Task 7: point URL /app/dashboard to a "Single Action" DashboardController
        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        // Task 8: Manage tasks with URL /app/tasks/***.
        Route::resource('tasks', TaskController::class);

    });

    // Task 9: /admin group within a group
    Route::group(['middleware' => 'is_admin', 'prefix' => 'admin'], function () {

        // Task 10: point URL /admin/dashboard to a "Single Action" Admin/DashboardController
        Route::get('/dashboard', App\Http\Controllers\Admin\DashboardController::class);


        // Task 11: point URL /admin/stats to a "Single Action" Admin/StatsController
        Route::get('/stats', App\Http\Controllers\Admin\StatsController::class);

    });
});

require __DIR__.'/auth.php';
