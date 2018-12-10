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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/


//-----------------------------------------------------------------------------

//authentication
Route::post('register', 'AuthController@register');
Route::post('login', [ 'as' => 'login', 'uses' => 'AuthController@login']);

//authorization + method
Route::group(['middleware' => ['jwt.verify']], function() {
//Route::group(['middleware' => ['api']], function() {

    Route::post('logout', 'AuthController@logout');
    Route::get('refresh', 'AuthController@refresh');

    Route::group(['middleware' => ['checkRole:admin|user']], function() {
        Route::get('user', 'AuthController@getAuthenticatedUser');

        //topics
        Route::get('topics', 'TopicController@index');
        Route::get('topics/{topic}', 'TopicController@show');
        Route::post('topics', 'TopicController@store');
        Route::put('topics/{topic}', 'TopicController@update');
        Route::delete('topics/{topic}', 'TopicController@delete');

        //posts
        Route::get('topics/{topic_id}/posts', 'PostController@index');
        Route::get('topics/{topic_id}/posts/{post}', 'PostController@show');
        Route::post('topics/{topic_id}/posts', 'PostController@store');
        Route::put('topics/{topic_id}/posts/{post}', 'PostController@update');
        Route::delete('topics/{topic_id}/posts/{post}', 'PostController@delete');

    });

    Route::group(['middleware' => ['checkRole:admin']], function() {
        Route::get('users', 'UserController@index');
    });
});








