<?php

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
    
    Route::resource('image', 'ImageController')->only(['show']);
    
    Route::post('report/{id}/report-message', 'ReportController@reportMessage')->name('report.reportMessage');
    
    Route::get('user/profile', 'UserController@profile')->name('user.profile');
    Route::get('user/change-password', 'UserController@changePassword')->name('user.changePassword');
    Route::get('user/deactivate-account', 'UserController@deactivateAccount')->name('user.deactivateAccount');
    Route::put('user/update-password', 'UserController@updatePassword')->name('user.updatePassword');
    Route::post('user/upload-profile-picture', 'UserController@uploadProfilePicture')->name('user.uploadProfilePicture');
    Route::post('user/upload-photo', 'UserController@uploadPhoto')->name('user.uploadPhoto');
    Route::delete('user/delete-profile-picture', 'UserController@deleteProfilePicture')->name('user.deleteProfilePicture');
    Route::delete('user/delete-photo/{id}', 'UserController@deletePhoto')->name('user.deletePhoto');
    Route::put('user/{user}/change-profile-picture', 'UserController@changeProfilePicture')->name('user.changeProfilePicture');
    Route::resource('user', 'UserController')->only(['update', 'destroy']);
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('room', 'Admin\RoomController');
    Route::get('room/{room}/delete', 'Admin\RoomController@delete')->name('room.delete');
    
    Route::resource('suggestion', 'Admin\SuggestionController')->only('index');
    
    Route::resource('report', 'Admin\ReportController')->only('index');

    Route::resource('user', 'Admin\UserController');
    Route::get('user/{user}/delete', 'Admin\UserController@delete')->name('user.delete');
    Route::post('user/{user}/update-ban-status/{status}', 'Admin\UserController@updateBanStatus')->name('user.updateBanStatus');
});