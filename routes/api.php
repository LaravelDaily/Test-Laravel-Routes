<?php

use App\Http\Controllers\Api\V1\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', fn(Request $request) => $request->user());

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'v1'], function() {
    Route::apiResource("/tasks", TaskController::class);
});