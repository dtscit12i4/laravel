<?php
    
    Route::get('/user', 'UsersController@index');

    Route::match(['get', 'post'],'/user/edit', 'UsersController@getUserEdit');

    Route::post('/user/editconfirm', 'UsersController@confirmEditUser');

    Route::put('/user/edit', 'UsersController@editUser');

    Route::post('/user/deleteconfirm', 'UsersController@confirmUserDelete');

    Route::delete('/user/delete', 'UsersController@destroy');
    
    Route::get('/user/add','UsersController@getAdd');

    Route::post('/user/addconfirm','UsersController@confirmAdd');

    Route::post('/user/add','UsersController@postAdd');



