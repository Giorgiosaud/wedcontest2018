<?php


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
Route::middleware('api')->get('countries', 'CountriesController@index')->name('api.countries.index');
Route::middleware('api')->get('users', 'UserApiController@index')->name('api.users.index');
Route::middleware('api')->get('gallery', 'ArtworkApiController@index')->name('api.artwork.index');
Route::middleware('api')->get('gallery/{contest}', 'ArtworkApiController@show')->name('api.artwork.show');
Route::middleware('api')->get('artworks/category/{category}', 'ArtworkApiController@get')->name('api.artwork.get');
