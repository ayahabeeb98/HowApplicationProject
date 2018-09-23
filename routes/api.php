<?php

use Illuminate\Http\Request;

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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'Api'],function (){
    Route::group(['middleware' => ['auth:api']],function() {
        Route::post('history/{v_id?}',['as' => 'history.add','uses'=>'UserApiController@history']);
        Route::get('showHistory',['as'=>'user.history','uses'=>'UserApiController@showHistory']);

        Route::group(['prefix' => 'video'], function () {
            Route::get('/all', ['as' => 'video.index', 'uses' => 'VideoApiController@index']);
            Route::get('/show/{id}', ['as' => 'video.show', 'uses' => 'VideoApiController@show']);
        });
        Route::group(['prefix' => 'category'], function () {
            Route::get('/all', ['as' => 'category.index', 'uses' => 'CategoryApiController@index']);
            Route::get('/show/{id}', ['as' => 'category.show', 'uses' => 'CategoryApiController@show']);
            Route::get('/videos/{id}',['as'=>'category.videos' ,'uses'=>'CategoryApiController@getVideos']);
        });
        Route::get('search/all', ['as' => 'search.index', 'uses' => 'SearchController@index']);
        Route::get('custom/logout/',['as' => 'user.logout', 'uses'=> 'LogOutApiController@ApiLogout' ]);

    });

    Route::post('/register',['as'=>'user.store','uses'=>'RegisterApiController@Register']);
    Route::get('recommended',['as'=>'recommended.videos','uses'=>'UserApiController@recommendedVideos']);
});