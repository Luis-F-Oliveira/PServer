<?php

use App\Http\Controllers\DietController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\WitnessController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('personals', PersonalController::class)
        ->except('show', 'destroy');

    Route::apiResource('exercises', ExerciseController::class);

    Route::apiResource('diets', DietController::class);

    Route::apiResource('forums', ForumController::class)
        ->only('index', 'store');

    Route::apiResource('witnesses', WitnessController::class)
        ->only('index', 'store');
});
