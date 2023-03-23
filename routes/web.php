<?php

use App\Room;

Auth::routes(['verify' => true]);

Route::get('/', function() {
    return view('guest');
})->name('guest')->middleware('guest');

// User routes
Route::middleware(['auth', 'verified', 'ban'])->group(function () {
    Route::get('room/show-more', 'RoomController@showMoreRooms')->name('room.showMoreRooms');
    Route::post('room/{room}/send-message', 'RoomController@sendMessage')->name('room.sendMessage');
    Route::post('room/{room}/leave', 'RoomController@leave')->name('room.leave');
    Route::resource('room', 'RoomController')->only(['index', 'show']);

    Route::resource('suggestion', 'SuggestionController')->only(['create', 'store']);
    
    Route::get('user/profile', 'UserController@profile')->name('user.profile');
    Route::get('user/change-password', 'UserController@changePassword')->name('user.changePassword');
    Route::get('user/deactivate-account', 'UserController@deactivateAccount')->name('user.deactivateAccount');
    Route::put('user/update-password', 'UserController@updatePassword')->name('user.updatePassword');
    Route::post('user/upload-profile-picture', 'UserController@uploadProfilePicture')->name('user.uploadProfilePicture');
    Route::delete('user/delete-profile-picture', 'UserController@deleteProfilePicture')->name('user.deleteProfilePicture');
    Route::resource('user', 'UserController')->only(['update', 'destroy']);
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('room', 'Admin\RoomController');
    Route::get('room/{room}/delete', 'Admin\RoomController@delete')->name('room.delete');
    
    Route::resource('user', 'Admin\UserController');
    Route::get('user/{id}/delete', 'Admin\UserController@delete')->name('user.delete');
    Route::post('user/{id}/update-ban-status/{status}', 'Admin\UserController@updateBanStatus')->name('user.updateBanStatus');
});