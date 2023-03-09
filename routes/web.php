<?php

use App\Room;

Auth::routes(['verify' => true]);

Route::get('/', function() {
    return view('guest');
})->name('guest')->middleware('guest');

// User routes
Route::middleware(['auth', 'verified', 'ban'])->group(function () {
    Route::get('room/show-more', 'RoomController@showMoreRooms')->name('room.showMoreRooms');
    Route::resource('room', 'RoomController')->only(['index', 'show']);

    Route::resource('suggestion', 'SuggestionController')->only(['create', 'store']);
    
    Route::resource('user', 'UserController')->only(['update']);
    Route::get('user/profile', 'UserController@profile')->name('user.profile');
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('room', 'Admin\RoomController');
    Route::get('room/{id}/delete', 'Admin\RoomController@delete')->name('room.delete');
    
    Route::resource('user', 'Admin\UserController');
    Route::get('user/{id}/delete', 'Admin\UserController@delete')->name('user.delete');
    Route::post('user/{id}/update-ban-status/{status}', 'Admin\UserController@updateBanStatus')->name('user.updateBanStatus');
});