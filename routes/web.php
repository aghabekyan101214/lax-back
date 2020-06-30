<?php

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


Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

/**
 * All admin route
 */
Route::group(['middleware' => 'auth'], function () {
    Route::get("/", "DashboardController@index");
    Route::resource("/makes", "MakeController");
    Route::post("/makes/change-status/{id}", "MakeController@changeStatus");

    Route::resource("/models", "CarModelController");
});
