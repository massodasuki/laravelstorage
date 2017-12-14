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

Route::get('/', 'AlbumController@index');
Route::get('/albums', 'AlbumController@index');
Route::get('/albums/create', 'AlbumController@create');
Route::get('/albums/{id}', 'AlbumController@show');

Route::delete('/albums/{id}', 'AlbumController@destroy');

Route::post('/store', 'AlbumController@store');



//id is for album id

Route::get('/photos/create/{id}', 'PhotoController@create');
Route::post('/photos/store', 'PhotoController@store');
Route::get('/photos/{id}', 'PhotoController@show');
Route::delete('/photos/{id}', 'PhotoController@destroy');

//hosting
Route::get('fileentry', 'FileEntryController@index');
Route::get('fileentry/get/{filename}', [
	'as' => 'getentry', 'uses' => 'FileEntryController@get']);
Route::post('fileentry/add',[ 
        'as' => 'addentry', 'uses' => 'FileEntryController@add']);



