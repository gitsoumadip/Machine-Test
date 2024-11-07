<?php

use App\Http\Controllers\Ajax\AjaxController;
use Illuminate\Support\Facades\Route;


Route::controller(AjaxController::class)->as('ajax.')->prefix('ajax')->group(function () {
    Route::post('/add-user-details', 'addUserDetails')->name('addUserDetails');
    Route::post('/state-by-country', 'getStateByCountry')->name('state-by-country');
    Route::post('/city-by-state', 'getCityByState')->name('city-by-state');
    Route::get('/relation', 'relations')->name('relation');

    Route::get('/fetchUserDetails', 'fetchUserDetails')->name('fetchUserDetails');
    Route::get('/fetchUserParentDetails/{id}', 'fetchUserParentDetails')->name('fetchUserParentDetails');
});
