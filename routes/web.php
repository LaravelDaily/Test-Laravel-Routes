<?php

use App\Http\Controllers\Admin\DashboardController;
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

// Task 1: point the main "/" URL to the HomeController method "index"
// Put one code line here below

Route::get('/', [HomeController::class, 'index']);

// Task 2: point the GET URL "/user/[name]" to the UserController method "show"
// It doesn't use Route Model Binding, it expects $name as a parameter
// Put one code line here below
Route::get('/user/{name}', [UserController::class, 'show']);

// Task 3: point the GET URL "/about" to the view
// resources/views/pages/about.blade.php - without any controller
// Also, assign the route name "about"
// Put one code line here below
Route::view('/about', view: 'pages.about')->name('about');

// Task 4: redirect the GET URL "log-in" to a URL "login"
// Put one code line here below
Route::get('/log-in', function () { return redirect('/login'); });

// Task 5: group the following route sentences below in Route::group()
// Assign middleware "auth"
// Put one Route Group code line here below

// Tasks inside that Authenticated group:

Route::middleware('auth')->group(function () {
    Route::get('/app/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/app/tasks', [TaskController::class, 'index'])->name('tasks.index');;
});

// Task 6: /app group within a group
// Add another group for routes with prefix "app"
// Put one Route Group code line here below

Route::prefix('app')
->name('tasks.')
   ->middleware('auth')
   ->group(function () {
       Route::get('/tasks', [TaskController::class, 'index'])->name('index');
    
       Route::post('/tasks', [TaskController::class, 'store'])->name('store');

       Route::get('/tasks/create', [TaskController::class, 'create'])->name('create');

       Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('show');

       Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('edit');

       Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('update');

       Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('destroy');
   });

// Tasks inside that /app group:

// Task 7: point URL /app/dashboard to a "Single Action" DashboardController
// Assign the route name "dashboard"
// Put one Route Group code line here below

// Task 8: Manage tasks with URL /app/tasks/***.
// Add ONE line to assign 7 resource routes to TaskController
// Put one code line here below

// End of the /app Route Group

// Task 9: /admin group within a group
// Add a group for routes with URL prefix "admin"
// Assign middleware called "is_admin" to them
// Put one Route Group code line here below

Route::prefix('admin')
->middleware(['auth', 'is_admin'])
->group(function () {
    Route::get('/dashboard', \App\Http\Controllers\Admin\DashboardController::class)
    ->name('admin.dashboard');
    Route::get('/stats', \App\Http\Controllers\Admin\StatsController::class)
    ->name('admin.stats');
});


// Tasks inside that /admin group:

// Task 10: point URL /admin/dashboard to a "Single Action" Admin/DashboardController
// Put one code line here below

// Task 11: point URL /admin/stats to a "Single Action" Admin/StatsController
// Put one code line here below

// End of the /admin Route Group

// End of the main Authenticated Route Group

// One more task is in routes/api.php

require __DIR__ . '/auth.php';
