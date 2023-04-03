<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Admin\DashboardController as DashController;
use App\Http\Controllers\Admin\StatsController;


// Task 1: point the main "/" URL to the HomeController method "index"
Route::get("/", [HomeController::class,"index"]);


// Task 2: point the GET URL "/user/[name]" to the UserController method "show"
// It doesn't use Route Model Binding, it expects $name as a parameter
Route::get('/user/{name}', [UserController::class,'show']);

require __DIR__.'/auth.php';
