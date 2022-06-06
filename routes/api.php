<?php

use App\Http\Controllers\Api\V1\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth:sanctum'], function() {
    // Task 12: Manage tasks with endpoint /api/v1/tasks/*****.
    Route::prefix('v1')->group(function () {
        Route::resource('tasks', TaskController::class);
    });
    // Keep in mind that prefix should be /api/v1.
    // Add ONE line to assign 5 resource routes to TaskController
    // Put one code line here below
