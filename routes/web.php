<?php

Auth::routes(['verify' => true]);

Route::get('/', function() {
    return view('guest');
})->name('guest')->middleware('guest');

Route::get('/home', function() {
    return view('home');
})->middleware(['verified', 'ban']);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('room', 'Admin\RoomController');
    Route::get('room/{id}/delete', 'Admin\RoomController@delete')->name('room.delete');
    
    Route::resource('user', 'Admin\UserController');
    Route::get('user/{id}/delete', 'Admin\UserController@delete')->name('user.delete');
    Route::post('user/{id}/update-ban-status/{status}', 'Admin\UserController@updateBanStatus')->name('user.updateBanStatus');
});