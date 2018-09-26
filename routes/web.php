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



Auth::routes();
Route::group(['middleware'=>'auth'],function () {
    Route::group(['prefix' => 'video'], function () {
        Route::get('/create','VideoController@create');
        Route::post('/create',['as'=>'video.create','uses'=>'VideoController@store']);
        Route::get('/all/{num?}', ['as' => 'video.index', 'uses' => 'VideoController@index']);
        Route::get('/destroy/{id?}',['as'=>'video.destroy','uses'=>'VideoController@destroy']);
        Route::get('/edit/{id}',['as'=>'video.edit','uses'=>'VideoController@edit']);
        Route::put('update/{id}', ['as' => 'video.update', 'uses' => 'VideoController@update']);
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('create', 'CategoryController@create');
        Route::post('create', ['as' => 'category.create', 'uses' => 'CategoryController@store']);
        Route::get('/all', ['as' => 'category.index', 'uses' => 'CategoryController@index']);
        Route::get('destroy/{id}', ['as' => 'category.destroy', 'uses' => 'CategoryController@destroy']);
        Route::get('edit/{id}', ['as' => 'category.edit', 'uses' => 'CategoryController@edit']);
        Route::put('update/{id}', ['as' => 'category.update', 'uses' => 'CategoryController@update']);
    });

    Route::group(['prefix' => 'user'],function (){
       Route::get('all/',['as' => 'user.index','uses'=>'UserController@index']);
    });

    Route::get('/logout/custom', ['as' => 'logout.custom', 'uses' => 'Controller@userLogout']);

});

Route::get('/home', 'HomeController@index')->name('home');
