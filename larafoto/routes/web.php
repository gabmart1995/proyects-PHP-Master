<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// config
Route::get('/config', 'UserController@config')->name('config');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/profile/{id}', 'UserController@profile')->name('user.profile');

// Images
Route::get('/images/create', 'ImageController@create')->name('image.create');
Route::post('/images/save', 'ImageController@save')->name('image.save');
Route::get('/images/file/{filename}', 'ImageController@getImage')->name('image.file');
Route::get('/images/detail/{id}', 'ImageController@detail')->name('image.detail');
Route::get('/images/delete/{id}', 'ImageController@delete')->name('image.delete');

// Comments
Route::post('/comments/store', 'CommentController@store')->name('comment.store');
Route::get('/comments/delete/{id}', 'CommentController@delete')->name('comment.delete');

// Likes Ajax
Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.dislike');
Route::get('/likes', 'LikeController@index')->name('like.index');