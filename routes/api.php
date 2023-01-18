<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
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
    Route::get('/api/v1/tasks', [TaskController::class, 'index']);
    Route::post('/api/v1/tasks', [TaskController::class, 'store']);
    Route::get('/api/v1/tasks/{id}', [TaskController::class, 'show']);
    Route::put('/api/v1/tasks/{id}', [TaskController::class, 'update']);
    Route::delete('/api/v1/tasks/{id}', [TaskController::class, 'destroy']);
});
