<?php


/*
 * Admin Routes
 */
Route::prefix('admin')->group(function() {

    Route::middleware('auth:admin')->group(function() {
        Route::get('/', 'UsersController@index')->name('home');
        // Users
        Route::resource('/users','UsersController');
        Route::get('/users/{id}/get', 'UsersController@getdata');
        // Logout
        Route::get('/logout','AdminUserController@logout');
        Route::resource('/register','RegisterController');
        
    });

    // Admin Login
    Route::get('/login', 'AdminUserController@index')->name('login');
    Route::post('/login', 'AdminUserController@store');
});

