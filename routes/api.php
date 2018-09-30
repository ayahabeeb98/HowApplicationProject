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

    Route::group(['prefix' => 'password' , 'middleware' => 'api'],function (){
        Route::post('create', 'PasswordResetController@create');
        Route::get('find/{token}', 'PasswordResetController@find');
        Route::post('reset', 'PasswordResetController@reset');
    });

    Route::group(['middleware' => ['auth:api']],function() {

        //....................History Routes.......................
        Route::group(['prefix' => 'history'],function (){
            Route::post('add/{video_id}',['as' => 'history.add','uses'=>'HistoryController@history']);
            Route::get('show',['as'=>'user.history','uses'=>'HistoryController@showHistory']);
            Route::delete('clear',['as'=>'history.clear' , 'uses' =>'HistoryController@clearHistory' ]);
        });

        //....................Favorite Routes.......................
        Route::group(['prefix' => 'favorite'],function (){
            Route::get('show',['as'=> 'show.favorite','uses'=>'FavoriteController@showFavorite']);
            Route::post('add/{video_id}',['as'=>'favorite.add','uses'=>'FavoriteController@addFavorite']);
            Route::get('delete/{id}',['as'=>'favorite.delete','uses'=>'FavoriteController@deleteFavorite']);
        });

        Route::group(['prefix' => 'user'],function (){
            Route::get('show',['as' => 'user.show','uses' => 'UserApiController@show']);
            Route::put('update/userName',['as' => 'update.userName' , 'uses' => 'UserApiController@updateName']);
            Route::put('update/email',['as' => 'update.email' , 'uses' => 'UserApiController@updateEmail']);
            Route::put('update/phone',['as' => 'update.phone' , 'uses' => 'UserApiController@updatePhone']);
            Route::put('update/image',['as' => 'update.image','uses' => 'UserApiController@updateImage']);
            Route::put('update/password',['as' => 'update.password','uses' => 'UserApiController@updatePassword']);

        });

        //....................Comments Routes.......................
        Route::group(['prefix' => 'comment'], function () {
            Route::get('show/{id}', 'commentApiController@showComment');
            Route::get('delete/{id}', 'commentApiController@deleteComment');
            Route::put('update/{id}', 'commentApiController@updateComment');
            Route::post('add/{id}', 'commentApiController@addComment');
        });

        //....................Video Routes.......................
        Route::group(['prefix' => 'video'], function () {
            Route::get('/all', ['as' => 'video.index', 'uses' => 'VideoApiController@index']);
            Route::get('/show/{id}', ['as' => 'video.show', 'uses' => 'VideoApiController@show']);
            Route::get('recommended',['as'=>'recommended.videos','uses'=>'VideoApiController@recommendedVideos']);
        });

        //....................Category Routes.......................
        Route::group(['prefix' => 'category'], function () {
            Route::get('/all', ['as' => 'category.index', 'uses' => 'CategoryApiController@index']);
            Route::get('/show/{id}', ['as' => 'category.show', 'uses' => 'CategoryApiController@show']);
            Route::get('/videos/{id}',['as'=>'category.videos' ,'uses'=>'CategoryApiController@getVideos']);
        });

        Route::get('search/all', ['as' => 'search.index', 'uses' => 'SearchController@index']);
        Route::get('custom/logout/',['as' => 'user.logout', 'uses'=> 'LogOutApiController@ApiLogout' ]);
    });
    Route::post('/register',['as'=>'user.store','uses'=>'RegisterApiController@Registration']);
});