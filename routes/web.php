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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/register user', "UserController@store");
    Route::get('/view user', "UserController@index")->name('Users'); 
    Route::resource('user', 'UserController');
    Route::resource('letter', 'LetterController');
    Route::get("/user/delete/{id}", "UserController@destroy");
    Route::get("/letter/search/{key}", 'LetterController@search');
    Route::post("/letter/forward/{letter_id}/{dep_id}", 'LetterController@forward'); 
});

// Route::get('/letter', "LetterController@view")->name('Letter');
Auth::routes();
