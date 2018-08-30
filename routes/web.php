<?php
    Route::prefix('user')->group(function () {
	    Route::get('/', 'UsersController@index');

	    Route::match(['get', 'post'],'edit', 'UsersController@getUserEdit');

	    Route::post('editconfirm', 'UsersController@confirmEditUser');

	    Route::put('edit', 'UsersController@editUser');

	    Route::post('deleteconfirm', 'UsersController@confirmUserDelete');

	    Route::delete('delete', 'UsersController@destroy');
	    
	    Route::get('add','UsersController@getAdd');

	    Route::post('addconfirm','UsersController@confirmAdd');

	    Route::post('add','UsersController@postAdd');
	});


