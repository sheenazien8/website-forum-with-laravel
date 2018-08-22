<?php

Route::group(['middleware' => "auth"], function() {
    Route::resource('quotes','QuoteController',['except' => ['index', 'show']]);
});
Route::get('/profile/{id?}', 'HomeController@profile')->name('profile');
Auth::routes();
Route::get('/','QuoteController@index');
Route::get('quotes/random', 'QuoteController@random')->name('quotes.random');
Route::resource('quotes','QuoteController',['only' => ['index', 'show']]);
