<?php

Auth::routes(['verify' => true]);

Route::get('/', function() {
    return view('guest');
})->name('guest')->middleware('guest');

Route::get('/home', function() {
    return view('home');
})->middleware('verified');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('room', 'Admin\RoomController');
    Route::get('room/{id}/delete', 'Admin\RoomController@delete')->name('room.delete');
});