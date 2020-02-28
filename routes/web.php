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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('users', 'UserController')->except([
        'destroy'
    ]);

    Route::group(['middleware' => ['role:admin']], function () {
        Route::delete('/users/{user}', 'UserController@destroy');
    });

    Route::get('admin', 'AdminController@index')->middleware('role:admin');

    Route::resource('books', 'BookController');

    Route::resource('checkouts', 'checkOutController');

    Route::resource('checkins', 'CheckInController');
    Route::get('vuejs/autocomplete/search', 'VueJSController@autocompleteSearch');
    Route::get('vuejs/autocompleteGenre/search', 'VueJsGenreController@autocompleteSearch');
});
