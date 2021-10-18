<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\TaskController;

use App\Http\Controllers\Admin\StatsController;

use App\Http\Controllers\Admin;



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

Route::get('/',[HomeController::class,'index']);

Route::get('/user/{name}',[UserController::class,'show']);

Route::view('/about','pages.about')->name('about');

Route::redirect('/log-in','/login');

Route::group(['middleware' => ['auth']], function () {

Route::group(['prefix'=>'app'], function () {

Route::get('/dashboard',DashboardController::class)->name('dashboard');

Route::Resource('tasks',TaskController::class);

});
    
Route::group(['prefix' =>'admin','middleware'=>'is_admin'], function () {

Route::get('dashboard',Admin\DashboardController::class);

Route::get('stats',StatsController::class);

});

});

require __DIR__.'/auth.php';
