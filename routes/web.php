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
    Route::post('/user', [App\Http\Controllers\ProfileController::class, 'update'])->name('users.update');
    Route::get('/user/{id}', [App\Http\Controllers\ProfileController::class, 'index'])->name('users.profile');
    Route::get('/users', [App\Http\Controllers\UsersController::class, 'list'])->name('users.list');
});

