<?php

use Illuminate\Http\Request;
use Modules\AuditLogs\Http\Controllers\AuditLogController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->group(function () {

    // Admin routes for audit-logs
    Route::middleware('role:admin')->group(function () {

        Route::get('/audit-logs', [AuditLogController::class, 'index']);
    });

});


