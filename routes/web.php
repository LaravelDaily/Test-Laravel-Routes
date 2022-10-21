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
// Put one code line here below
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

// Task 2: point the GET URL "/user/[name]" to the UserController method "show"
// It doesn't use Route Model Binding, it expects $name as a parameter
// Put one code line here below
Route::get('/user/{name}', [\App\Http\Controllers\UserController::class, 'show']);

// Task 3: point the GET URL "/about" to the view
// resources/views/pages/about.blade.php - without any controller
// Also, assign the route name "about"
// Put one code line here below
Route::view('/about', 'pages.about')->name('about');

// Task 4: redirect the GET URL "log-in" to a URL "login"
// Put one code line here below
Route::redirect('log-in', 'login');

// Task 5: group the following route sentences below in Route::group()
// Assign middleware "auth"
// Put one Route Group code line here below
Route::group(['middleware' => 'auth'], function (){
    Route::group(['prefix' => 'app'], function (){
        Route::get('dashboard', \App\Http\Controllers\DashboardController::class)->name('dashboard');
        Route::resource('tasks', \App\Http\Controllers\TaskController::class);
    });
    Route::group(['prefix' => 'admin', 'middleware' => 'is_admin', 'namespace' => 'Admin'], function (){
        Route::get('dashboard', 'DashboardController');
        Route::get('stats', 'StatsController');
    });
});

require __DIR__.'/auth.php';
