<?php

use App\Http\Controllers\Api\V1\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    // Task 12: Manage tasks with endpoint /api/v1/tasks/*****.
    // Keep in mind that prefix should be /api/v1.
    // Add ONE line to assign 5 resource routes to TaskController
    // Put one code line here below
    Route::prefix('/v1')->name('v1.')->group(function () {
        // Route::resource('/tasks',TaskController::class)->only([
        //     'index',
        //     'store',
        //     'show',
        //     'update',
        //     'destroy',
        // ]);

        Route::apiResource('/tasks', TaskController::class);

        // the below will make all route name be like that: v1.p.show || api/v1/tasks/{task}
        // Route::apiResource('/tasks', TaskController::class)->names('p');

        // the below will make URI be like that: api/v1/p/{p} || v1.tasks.show
        // Route::apiResource('/p', TaskController::class)->names('tasks');
    });
});
