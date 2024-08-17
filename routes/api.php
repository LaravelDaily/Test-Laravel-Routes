<?php

use App\Http\Controllers\Api\V1\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->middleware('auth:sanctum')->group( function() {
    // Task 12: Manage tasks with endpoint /api/v1/tasks/*****.
    // Keep in mind that prefix should be /api/v1.
    // Add ONE line to assign 5 resource routes to TaskController
    // Put one code line here below
    Route::resource('tasks', TaskController::class);

});
