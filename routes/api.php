<?php

use App\Http\Controllers\Api\V1\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

	@@ -23,5 +24,6 @@
    // Keep in mind that prefix should be /api/v1.
    // Add ONE line to assign 5 resource routes to TaskController
    // Put one code line here below
    Route::resource('/v1/tasks', TaskController::class);

});
