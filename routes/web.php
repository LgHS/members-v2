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
});

