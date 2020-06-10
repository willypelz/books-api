<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*******************************************
 *******************************************
 *****  Books API Version 1  ***************
 *******************************************
 *******************************************/


Route::namespace('Api\v1')->prefix('v1')->group(function () {
    Route::group(['namespace' => 'Books'], function () {
        Route::resource('books', 'BooksController');
        Route::get('external-books', 'BooksController@externalBook')->name('books.external');
    });
});
