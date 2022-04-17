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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');


//ログイン中のページ
Route::get('/top','PostsController@index');
Route::post('/top', 'PostsController@store');


Route::get('{id}/delete', 'PostsController@delete');

Route::get('{id}/update', 'PostsController@updateForm');
Route::get('{id}/update2', 'PostsController@update');

Route::get('{id}/profile','UsersController@profileUpdate');

Route::post('/search', 'UserController@follow');
Route::post('/search', 'UserController@unfollow');

Route::get('/profile','UsersController@profile');
Route::post('/profile','UsersController@profile');


Route::post('/search', 'UsersController@follow')->name('follow');
Route::delete('/search', 'UsersController@unfollow')->name('unfollow');

Route::group(['prefix' => 'users'], function() {
        Route::get('edit/{id}', 'UsersController@getEdit')->name('layouts.profile');
        Route::post('edit/{id}', 'UsersController@postEdit')->name('layouts.profile');
    });


Route::get('/search','UsersController@searchForm');
Route::post('/search','UsersController@searchForm');

Route::get('/result','UsersController@search');
Route::post('/result','UsersController@search');


Route::get('/follow-list','PostsController@index');
Route::get('/follower-list','PostsController@index');

Route::get('/logout', 'Auth\LoginController@logout');
Route::post('/logout', 'Auth\LoginController@logout');

//Route::post('/posts','PostsController@index');
//Route::get('/posts','PostsController@index');
