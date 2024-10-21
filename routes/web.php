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
Route::get('/', [HomeController::class, 'index'] );


// Task 2: point the GET URL "/user/[name]" to the UserController method "show"
// It doesn't use Route Model Binding, it expects $name as a parameter
// Put one code line here below
Route::get('/user/{name}', [UserController::class, 'show'] );



// Task 3: point the GET URL "/about" to the view
// resources/views/pages/about.blade.php - without any controller
// Also, assign the route name "about"
// Put one code line here below
Route::get('/about', function() {
return view('pages.about);
})->name('about');


// Task 4: redirect the GET URL "log-in" to a URL "login"
// Put one code line here below
Route::redirect('/log-in', '/login');


// Task 5: group the following route sentences below in Route::group()
// Assign middleware "auth"
// Put one Route Group code line here below
Route::group(['middleware' => 'auth'], function () {
 // Tasks inside that Authenticated group:
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});

//or
Route::middleware('auth')->group(function() {
 // Tasks inside that Authenticated group:
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
})

    // Task 6: /app group within a group
    // Add another group for routes with prefix "app"
    // Put one Route Group code line here below


    Route::group(['middleware' => 'auth'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::group(['prefix' => 'app'], function () {
         // Tasks inside that /app group:
            Route::get('/', [AppController::class, 'index'])->name('app.index');
            Route::get('/create', [AppController::class, 'create'])->name('app.create');
        });
    });


        // Task 7: point URL /app/dashboard to a "Single Action" DashboardController
        // Assign the route name "dashboard"
        // Put one Route Group code line here below

        Route::group(['prefix' => 'app', 'middleware' => 'auth'], function () {
            Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)->name('dashboard');
        });



        // Task 8: Manage tasks with URL /app/tasks/***.
        // Add ONE line to assign 7 resource routes to TaskController
        // Put one code line here below
        Route::group(['prefix' => 'app', 'middleware' => 'auth'], function () {
            Route::resource('tasks', TaskController::class);
            Route::get('tasks/{any}', [TaskController::class, 'handleAny'])->where('any', '.*')->name('tasks.any');
        });
    // End of the /app Route Group


    // Task 9: /admin group within a group
    // Add a group for routes with URL prefix "admin"
    // Assign middleware called "is_admin" to them
    // Put one Route Group code line here below
     Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function () {
             Route::group(['prefix' => 'app'], function () {
                Route::get('/', [AppController::class, 'index'])->name('app.index');
                Route::get('/create', [AppController::class, 'create'])->name('app.create');
            });
        });
    // second approach is the correct one as the prefix is protected under middleware, whereas in my approach which is in the first one, i have directly used both prefix and middleware in a single group route
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function () {
        // Tasks inside that /admin group:
        Route::group(['prefix' => 'app'], function () {
                Route::get('/', [AppController::class, 'index'])->name('app.index');
                Route::get('/create', [AppController::class, 'create'])->name('app.create');
            });
        });
    });


        // Task 10: point URL /admin/dashboard to a "Single Action" Admin/DashboardController
        // Put one code line here below
        Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function () {
            Route::get('/dashboard', \App\Http\Controllers\Admin\DashboardController::class)->name('admin.dashboard');
        });


        // Task 11: point URL /admin/stats to a "Single Action" Admin/StatsController
        // Put one code line here below
        Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function () {
            Route::get('/stats', \App\Http\Controllers\Admin\StatsController::class)->name('admin.stats');
    // End of the /admin Route Group
        });
// End of the main Authenticated Route Group

// One more task is in routes/api.php

require __DIR__.'/auth.php';
