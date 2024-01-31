<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Admin\DashboardController;


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
Route::get('/user/{name}', [UserController::class, 'show']);


// Task 3: point the GET URL "/about" to the view
// resources/views/pages/about.blade.php - without any controller
// Also, assign the route name "about"
// Put one code line here below
Route::get('/about', function() {
    return view('pages.about');
});



// Task 4: redirect the GET URL "log-in" to a URL "login"
// Put one code line here below
Route::redirect('/log-in', '/login');



// Task 5: point the GET URL "/user/[name]/profile" to the UserController method "profile"
Route::group(['middleware' => 'auth'], function() {
    // Task 6: point the GET URL "/user/[name]/profile" to the UserController method "profile"
Route::group(['prefix' => 'app'], function() {
    // Task-7: Tasks inside that /app group:
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
// Task 8: Manage tasks with URL /app/tasks/***.
Route::resource('tasks', 'TaskController');
});

});

Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function() {
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::get('/stats', 'Admin\StatsController@index')->name('admin.stats');
});

require __DIR__.'/auth.php';
