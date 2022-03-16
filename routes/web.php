<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'keycloak'], function () {
    Route::get('/', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::get('/roles', [App\Http\Controllers\ProfileController::class, 'roles'])->name('roles');
    Route::group(['prefix' => 'users', 'as' => 'users::'], function () {
        Route::post('/', [App\Http\Controllers\ProfileController::class, 'update'])->name('update');
        Route::get('/{id}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
        Route::get('/', [App\Http\Controllers\UserController::class, 'list'])->name('list');
    });
    Route::group(['prefix' => 'badges', 'as' => 'badges::'], function () {
        Route::post('/', [App\Http\Controllers\BadgeController::class, 'store'])->name('store');
        Route::get('/{id}', [App\Http\Controllers\BadgeController::class, 'view'])->name('view');
        Route::get('/', [App\Http\Controllers\BadgeController::class, 'list'])->name('list');
        Route::delete('/{id}', [App\Http\Controllers\BadgeController::class, 'destroy'])->name('destroy');
    });
    Route::group(['prefix' => 'accesses', 'as' => 'accesses::'], function () {
        Route::post('/', [App\Http\Controllers\AccessController::class, 'generate'])->name('generate');
        Route::get('/', [App\Http\Controllers\AccessController::class, 'list'])->name('list');
        Route::delete('/{api_token}', [App\Http\Controllers\AccessController::class, 'destroy'])->name('destroy');
    });
    Route::get('/inject-roles', [\App\Http\Controllers\BadgeController::class, 'injectRoles'])->name('inject-roles');
});

Route::post('deploy', [\App\Http\Controllers\DeployController::class, 'deploy'])->name('deploy');

