<?php

Auth::routes(['verify' => true]);

Route::get('/home', function() {
    echo "Bienvenido";
})->middleware('verified');