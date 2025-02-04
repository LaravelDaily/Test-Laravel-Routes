<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StatsController;
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

// Task 1: Point the main "/" URL to the HomeController method "index"
Route::get('/', [HomeController::class, "index"]);

// Task 2: Point the GET URL "/user/[name]" to the UserController method "show"
// It doesn't use Route Model Binding, it expects $name as a parameter
Route::get('/user/{name}', [UserController::class, 'show']);

// Task 3: Point the GET URL "/about" to the view (resources/views/pages/about.blade.php)
// Also, assign the route name "about"
Route::view('/about', 'pages.about')->name('about');

// Task 4: Redirect the GET URL "/log-in" to "/login"
Route::redirect('/log-in', '/login');

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Requires "auth" Middleware)
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth']], function () {

    /*
    |--------------------------------------------------------------------------
    | /app Routes (Prefix "app")
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'app'], function () {

        // Task 7: Single-Action Controller for Dashboard
        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        // Task 8: Manage tasks with resourceful routes
        Route::resource('/tasks', TaskController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | /admin Routes (Prefix "admin" with "is_admin" Middleware)
    |--------------------------------------------------------------------------
    */
    Route::group(['middleware' => ['is_admin'], 'prefix' => 'admin'], function () {

        // Task 10: Single-Action Controller for Admin Dashboard
        Route::get('/dashboard', DashboardController::class);

        // Task 11: Single-Action Controller for Admin Stats
        Route::get('/stats', StatsController::class);
    });
});

// One more task is in routes/api.php

require __DIR__ . '/auth.php';