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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);


Route::get('/user/{name}', [App\Http\Controllers\UserController::class, 'show']);

Route::view('/about', 'pages/about')->name('about');


// Task 4: redirect the GET URL "log-in" to a URL "login"
// Put one code line here below
Route::get('log-in', function () {
    
    return Redirect::to('login');
});

        Route::group(['middelware' => 'auth'], function () {
            Route::group(['prefix' => '/app'], function () {
                Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
                Route::resource('/tasks', App\Http\Controllers\TaskController::class);
            });
            
            Route::group(['prefix' => '/admin', 'middleware' => ['is_admin']], function () {
                     Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
                     Route::get('/stats', [App\Http\Controllers\Admin\StatsController::class, 'index']);
                });
        });

        

// End of the main Authenticated Route Group

// One more task is in routes/api.php

require __DIR__.'/auth.php';
