<?php


/*
 * Admin Routes
 */
Route::prefix('admin')->group(function() {

    Route::middleware('auth:admin')->group(function() {
        // Route::get('/', 'UsersController@index')->name('home');
        Route::get('/', 'AdminUserController@getUser')->name('home');
        Route::post('/search', 'AdminUserController@search');
        Route::get('/getname/{id}', 'AdminUserController@getLoginName');
        Route::post('/getname/{id}', 'AdminUserController@destroy');
        // Users
        // Route::resource('/users','UsersController');
        Route::get('/users/{id}/get', 'UsersController@getdata');
        // Logout
        Route::get('/logout','AdminUserController@logout');
        // Route::resource('/register','RegisterController');
        Route::get('/register','AdminUserController@getRegister');
        Route::post('/register','AdminUserController@postRegister');
        Route::get('/edit/{id}','AdminUserController@edit');
        Route::post('/edit/{id}','AdminUserController@update');
        
    });

    // Admin Login
    Route::get('/login', 'AdminUserController@index')->name('login');
    Route::post('/login', 'AdminUserController@store');
});

