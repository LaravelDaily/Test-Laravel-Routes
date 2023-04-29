<?php

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

Route::group(['middleware' => 'auth:sanctum','prefix'=>'v1'], function() {
    // Task 12: Manage tasks with endpoint /api/v1/tasks/*****.
    // Keep in mind that prefix should be /api/v1.
    // Add ONE line to assign 5 resource routes to TaskController
    // Put one code line here below
    Route::resource('tasks',App\Http\Controllers\Api\V1\TaskController::class)->except(['create','edit']);
});
Route::get('hi',function (){
   return response()->json([
      'status'=>'200',
      'data'=>'Executed successfuly MAL3OOOOOOBA'
   ],200);
});

Route::get('students',[\App\Http\Controllers\Api\StudentsController::class,'index']);
Route::get('students/{id}',[\App\Http\Controllers\Api\StudentsController::class,'show']);
Route::post('students',[\App\Http\Controllers\Api\StudentsController::class,'store']);
