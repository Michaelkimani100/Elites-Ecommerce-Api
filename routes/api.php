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
// Route::get('example', array('middleware' => 'cors', 'uses' => 'ExampleController@dummy'));
Route::post('login', 'Api\PassportController@login');
Route::post('register', 'Api\PassportController@register');
Route::apiResources(['category' => 'Api\CategoryController']);
Route::apiResources(['product' => 'Api\ProductController']);
Route::apiResources(['image' => 'Api\ImageController']);
Route::apiResources(['rating' => 'Api\RatingController']);
