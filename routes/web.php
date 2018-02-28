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
//Route::get('/', function () {
//    return view('welcome');
//});
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();

    Route::get('contests','ContestsController@index')->name('contests');
    Route::get('contests/create', 'ContestsController@create');
    Route::post('contests','ContestsController@store');
    Route::get('contests/{contest}','ContestsController@show');



    Route::get('the_contest',function(){
        return 'the_contest';
    })->name('the_contest');




    Route::get('contests/{contest}/categories','CategoriesController@index')->name('categories');;



    Route::get('/register/confirm', 'Auth\RegisterConfirmationController@index')->name('register.confirm');


});
