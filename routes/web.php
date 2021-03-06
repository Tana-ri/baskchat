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

Route::get('/', 'PostsController@index');

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ユーザ機能
Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    Route::resource('posts', 'PostsController', ['only' => ['store', 'destroy']]);
});


 Route::group(['prefix' => 'users/{id}'], function () {
    Route::get('likes', 'UsersController@likes')->name('users.likes');    // 追加
});

 Route::group(['prefix' => 'posts/{id}'], function () {
        Route::post('like', 'LikesController@store')->name('likes.like');
        Route::delete('unlike', 'LikesController@destroy')->name('likes.unlike');
 });
 
Route::resource('posts', 'PostsController', ['only' => ['store', 'destroy']]);
;

//予想投票画面まだできてない
Route::resource('votes','VotesController',['only' => ['index']]);

//試合日程に飛ばす
Route::resource('games', 'GamesController', ['only' => ['index']]);

//選手情報に飛ばす,国
Route::resource('countries', 'CountriesController', ['only' => ['index']]);

Route::resource('players', 'PlayersController');
