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

Route::get('/', 'WelcomeController@index')->name('welcome');

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
   
Route::get('books/business', 'BooksController@business')->name('books.business');
Route::get('books/lang', 'BooksController@lang')->name('books.lang');
Route::get('books/novel', 'BooksController@novel')->name('books.novel');
Route::get('books/pc', 'BooksController@pc')->name('books.pc');
Route::get('books/shikaku', 'BooksController@shikaku')->name('books.shikaku');
Route::get('books/society', 'BooksController@society')->name('books.society');
Route::get('books/others', 'BooksController@others')->name('books.others');
Route::get('books/rakuten', 'BooksController@rakuten')->name('books.rakuten');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('books', 'BooksController', ['only' => ['create', 'show']]);
    Route::get('books/{id}/goodluck', 'BooksController@goodluck')->name('books.goodluck');
    Route::post('have', 'BookUserController@have')->name('book_user.have');
    Route::delete('have', 'BookUserController@dont_have')->name('book_user.dont_have');
    Route::resource('users', 'UsersController', ['only' => ['show','index','destroy']]);
    Route::get('taikai', 'UsersController@taikai')->name('users.taikai');
    
    Route::get('news', 'UsersController@news')->name('users.news');
    Route::delete('confirm', 'UsersController@confirm')->name('users.confirm');
    
    Route::get('home', 'UsersController@home')->name('users.home');
    Route::get('ranking', 'UsersController@ranking')->name('users.ranking');
    
    Route::put('users/{id}', 'UsersController@update')->name('users.update');
    Route::get('users/{id}/edit', 'UsersController@edit')->name('users.edit');
    
    
    Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy']]);
    
    Route::group(['prefix' => 'goodluck/{id}'], function () {
    Route::post('notice', 'UserNoticeController@store')->name('user.notice');
    Route::delete('dont_notice', 'UserNoticeController@destroy')->name('user.dont_notice');
    });
});


