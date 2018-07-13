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

Route::get('/', 'WelcomeController@index');

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('books', 'BooksController', ['only' => ['create', 'show']]);
    Route::get('books/{id}/goodluck', 'BooksController@goodluck')->name('books.goodluck');
    Route::post('have', 'BookUserController@have')->name('book_user.have');
    Route::delete('have', 'BookUserController@dont_have')->name('book_user.dont_have');
    Route::resource('users', 'UsersController', ['only' => ['show','index']]);
});


