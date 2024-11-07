<?php

use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

// Route::namespace('Users')->as('user.')->prefix('user')->controller(UserController::class)->group(function () {
Route::controller(UserController::class)->prefix('user')->as('user.')->group(function () {
    Route::get('/', 'index')->name('list');
    Route::get('/add', 'create')->name('add');
    Route::get('/parent-details/{id}', 'fetchUserParentDetails')->name('fetchUserParentDetails');
});
