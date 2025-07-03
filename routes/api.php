<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware([SetLocale::class])->group(function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::apiResource('tasks', \App\Http\Controllers\TaskController::class);
    });
});

require __DIR__ . '/auth.php';
