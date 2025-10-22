<?php

use Illuminate\Http\Request;
use Modules\Tasks\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::get('/search_tasks', [TaskController::class, 'search_query'])->name('tasks.search');


});


