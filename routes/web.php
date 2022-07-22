<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('/superuser')->name('superuser.')->group(function () {
        Route::resource('permission', App\Http\Controllers\Superuser\PermissionController::class)->only([
            'index', 'store', 'update', 'destroy',
        ]);

        Route::resource('role', App\Http\Controllers\Superuser\RoleController::class)->only([
            'index', 'store', 'update', 'destroy',
        ]);

        Route::patch('/role/{role}/detach/{permission}', [App\Http\Controllers\Superuser\RoleController::class, 'detach'])->name('role.detach');

        Route::resource('user', App\Http\Controllers\Superuser\UserController::class)->only([
            'index', 'store', 'update', 'destroy',
        ]);

        Route::patch('/user/{user}/role/{role}/detach', [App\Http\Controllers\Superuser\UserController::class, 'detachRole'])->name('user.role.detach');
        Route::patch('/user/{user}/permission/{permission}/detach', [App\Http\Controllers\Superuser\UserController::class, 'detachPermission'])->name('user.permission.detach');

        Route::resource('menu', App\Http\Controllers\Superuser\MenuController::class)->only([
            'index', 'store', 'update', 'destroy',
        ]);

        Route::patch('/menu/{menu}/up', [App\Http\Controllers\Superuser\MenuController::class, 'up'])->name('menu.up');
        Route::patch('/menu/{menu}/down', [App\Http\Controllers\Superuser\MenuController::class, 'down'])->name('menu.down');
        Route::patch('/menu/{menu}/left', [App\Http\Controllers\Superuser\MenuController::class, 'left'])->name('menu.left');
        Route::patch('/menu/{menu}/right', [App\Http\Controllers\Superuser\MenuController::class, 'right'])->name('menu.right');
    });
});