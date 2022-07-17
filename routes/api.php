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

Route::prefix('/v1')->name('api.v1.')->group(function () {
    Route::get('/user/{user}/menu', fn (App\Models\User $user) => $user->menus())->name('user.menu');

    Route::name('superuser.')->group(function () {
        Route::get('/superuser/permission', [App\Http\Controllers\Superuser\PermissionController::class, 'get'])->name('permission');
    });
});