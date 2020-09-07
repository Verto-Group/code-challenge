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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('ping', function () {
    return 'Alive !';
});

Route::get('test', 'PhotoController@test');

Route::group(['prefix' => 'photo'], function () {
    Route::post('search', 'PhotoController@search');
});

Route::group(['prefix' => 'photo'], function () {
    Route::post('search', 'PostController@search');
    Route::post('saved', 'PostController@saved');
    Route::get('test', 'PostController@test');
    
    // Route::get('edit/{id}', 'PostController@edit');
    // Route::post('update/{id}', 'PostController@update');
    // Route::delete('delete/{id}', 'PostController@delete');
});