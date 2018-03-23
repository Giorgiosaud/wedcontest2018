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

Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'localize'], // Route translate middleware

], function () {
//    Route::get('/',function(){
//        return 'hola';
//    });
    /* ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::redirect('/', 'the_contest');
    Route::get(LaravelLocalization::transRoute('routes.the_contest'), 'TheContestController@index')
        ->name('the_contest');

    Auth::routes();

    Route::get('contests', 'ContestsController@index')->name('contests');
    Route::get('contests/create', 'ContestsController@create');
    Route::post('contests', 'ContestsController@store');
    Route::get('contests/{contest}', 'ContestsController@show');

    Route::get('contests/{contest}/categories', 'CategoriesController@index')->name('categories');

    Route::get('/register/confirm', 'Auth\RegisterConfirmationController@index')->name('register.confirm');
    Route::get('/profile', function () {
        return 'profile';
    })->name('profile');
    Route::post('/images/upload', 'ImageController@store')->name('store.image');
});
