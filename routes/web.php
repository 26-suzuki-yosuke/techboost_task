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



Route::get('/', function () {
    return view('welcome');
});

/*
Route::get('admin/news/create', function () {
    return view('admin/news/create');
});
*/

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
   Route::get('profile/create', 'Admin\ProfileController@add'); 
   Route::get('profile/edit', 'Admin\ProfileController@edit');
   Route::post('profile/create', 'Admin\ProfileController@create');
   Route::post('profile/edit', 'Admin\ProfileController@update');
   Route::get('profile', 'Admin\ProfileController@index');
   Route::get('profile/delete', 'Admin\ProfileController@delete');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     Route::get('news/create', 'Admin\NewsController@add');
     Route::post('news/create', 'Admin\NewsController@create'); # 追記
     Route::get('news', 'Admin\NewsController@index');
     Route::get('news/edit', 'Admin\NewsController@edit'); // 追記
     Route::post('news/edit', 'Admin\NewsController@update');
     Route::get('news/delete', 'Admin\NewsController@delete');
});

//Route::get('admin/news/create', 'Admin\NewsController@add')->middleware('auth');

/*
Route::group(['prefix' => 'admin'], function() {
    Route::get('news/create', 'Admin\NewsController@add');
});
*/

/*
Route::get('/', function () {
    return view('admin/news/create');
});
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'NewsController@index');
Route::get('/', 'ProfileController@index');
