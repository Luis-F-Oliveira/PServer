<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionUserController;
use App\Http\Controllers\RoleOnUserController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('roles_on_users', RoleOnUserController::class);

    Route::apiResource('roles', RoleController::class)
        ->except('update');

    Route::apiResource('users', UserController::class)
    ->except('store');

    Route::get('permissions/{id}', [PermissionUserController::class, 'index'])
    ->name('permissions');
});
