<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\UserController@form_login')->name('login');
Route::post('/authenticate', 'App\Http\Controllers\UserController@authenticate')->name('authenticate');

Route::get('/register', 'App\Http\Controllers\UserController@form_register')->name('user.form_register');
Route::post('/register-post', 'App\Http\Controllers\UserController@store')->name('user.store');

// API
Route::post('/authenticate_api', 'App\Http\Controllers\UserController@authenticate_api')->name('authenticate_api');
Route::post('/register-post-api', 'App\Http\Controllers\UserController@register')->name('user.register');

// Route::group(['middleware' => ['auth','CheckRole:Admin,User']], function(){
    Route::get('/news', 'App\Http\Controllers\NewsController@index')->name('news.index');
    Route::get('/news/{id}/edit', 'App\Http\Controllers\NewsController@edit')->name('news.edit');
    Route::get('/news/{id}/komentar', 'App\Http\Controllers\NewsController@komentar')->name('news.komentar');
    Route::post('/komentar-post', 'App\Http\Controllers\NewsController@post_komentar')->name('news.post_komentar');

    // API
    Route::get('/get_news_list', 'App\Http\Controllers\NewsController@get_news_list')->name('news.get_news_list');
// });

// Route::group(['middleware' => ['auth','CheckRole:Admin']], function(){
    Route::get('/news-create', 'App\Http\Controllers\NewsController@create')->name('news.create');
    Route::post('/news-post', 'App\Http\Controllers\NewsController@store')->name('news.store');
    Route::post('/news/{id}/update', 'App\Http\Controllers\NewsController@update')->name('news.update');
    Route::get('/news/{id}/delete', 'App\Http\Controllers\NewsController@destroy')->name('news.delete');

    // API
    Route::post('/news_create_api', 'App\Http\Controllers\NewsController@post_news')->name('news.news_create_api');
    Route::get('/news-api/{id}/detail_news', 'App\Http\Controllers\NewsController@detail_news')->name('news.detail_news');
    Route::post('/news-api/{id}/update_news', 'App\Http\Controllers\NewsController@update_news')->name('news.update_news');
    Route::get('/news-api/{id}/delete', 'App\Http\Controllers\NewsController@destroy_news')->name('news.destroy_news');
// });

Route::get('/logout', 'App\Http\Controllers\UserController@logout')->name('logout');


