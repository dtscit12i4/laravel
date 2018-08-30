<?php
/**
 * setup route user
 */
    Route::prefix('user')->group(function () {
	    Route::get('/', 'UsersController@index')->name('user.index');

	    Route::match(['get', 'post'],'edit', 'UsersController@getUserEdit')->name('user.getuseredit');

	    Route::post('editconfirm', 'UsersController@confirmEditUser')->name('user.confirmedituser');

	    Route::put('edit', 'UsersController@editUser')->name('user.editUser');

	    Route::post('deleteconfirm', 'UsersController@confirmUserDelete')->name('user.confirmuserdelete');

	    Route::delete('delete', 'UsersController@destroy')->name('user.destroy');
	    
	    Route::get('add','UsersController@getAdd')->name('user.getadd');

	    Route::post('addconfirm','UsersController@confirmAdd')->name('user.confirmadd');

	    Route::post('add','UsersController@postAdd')->name('user.postadd');
	});


