<?php

Route::get('/profile/{id?}', 'HomeController@profile')->name('profile');
Route::get('/forum/filter/{id}', 'QuoteController@filtag')->name('forum.filtag');

Route::group(['middleware' => "auth"], function() {
    Route::resource('forum','QuoteController',['except' => ['index', 'show']]);
    Route::post('forum-comment/{id}',"CommentController@store")->name('comments.store');
    Route::get('forum-comment/{id}/edit',"CommentController@edit")->name('comments.edit');
    Route::patch('forum-comment/{id}/update',"CommentController@update")->name('comments.update');
    Route::delete('forum-comment/{id}/destroy',"CommentController@destroy")->name('comments.destroy');
    Route::get('/like/{type}/{model}','LikeController@like')->name('like');
    Route::get('/unlike/{type}/{model}','LikeController@unlike')->name('unlike');
    Route::get('/notifications','HomeController@getNotif')->name('notification');
});
Auth::routes();
Route::get('/',function()
{
	return view('welcome');
});

Route::get('forum/random', 'QuoteController@random')->name('forum.random');
Route::resource('forum','QuoteController',['only' => ['index', 'show']]);
