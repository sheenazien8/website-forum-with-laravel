<?php

Route::get('/profile/{id?}', 'HomeController@profile')->name('profile');
Route::get('/quotes/filter/{id}', 'QuoteController@filtag')->name('quotes.filtag');
Route::group(['middleware' => "auth"], function() {
    Route::resource('quotes','QuoteController',['except' => ['index', 'show']]);
    Route::post('quotes-comment/{id}',"CommentController@store")->name('comments.store');
    Route::get('quotes-comment/{id}/edit',"CommentController@edit")->name('comments.edit');
    Route::patch('quotes-comment/{id}/update',"CommentController@update")->name('comments.update');
    Route::delete('quotes-comment/{id}/destroy',"CommentController@destroy")->name('comments.destroy');
    Route::get('/like/{type}/{model}','LikeController@like')->name('like');
    Route::get('/unlike/{type}/{model}','LikeController@unlike')->name('unlike');
    Route::get('/notifications','HomeController@getNotif')->name('notification');
});
Auth::routes();
Route::get('/','QuoteController@index');
Route::get('quotes/random', 'QuoteController@random')->name('quotes.random');
Route::resource('quotes','QuoteController',['only' => ['index', 'show']]);
