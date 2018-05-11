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
Route::get('test', 'TestController@test');
Route::get('lang/{route}/{language}', 'LanguageController@switchLang')->name('lang.switch');
Route::post('/contestant', 'ContestantController@store')->name('contestant.store');
Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'localize'], // Route translate middleware

], function () {
    Auth::routes();

    Route::redirect('/', 'the_contest');
    Route::get(LaravelLocalization::transRoute('routes.the_contest'), 'TheContestController@index')
        ->name('the_contest');
    Route::get('contests', 'ContestsController@index')->middleware('admin')->name('contests.index');
    Route::get('contests/create', 'ContestsController@create')->middleware('admin')->name('contests.create');
    Route::post('contests', 'ContestsController@store')->middleware('admin')->name('contests.store');
    Route::get('contests/{contest}', 'ContestsController@show')->middleware('admin')->name('contests.show');
    Route::get('contests/{contest}/edit', 'ContestsController@edit')->middleware('admin')->name('contests.edit');
    Route::put('contests/{contest}', 'ContestsController@update')->middleware('admin')->name('contests.update');
    // Route::resource('contests', 'ContestsController');

    Route::get('contests/{contest}/categories', 'CategoriesController@index')->middleware('admin')->name('categories');

    Route::get('/register/confirm', 'Auth\RegisterConfirmationController@index')->name('register.confirm');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::post('/profile', 'ProfileController@update')->name('profile.update');
    Route::get('/contestants', 'ContestantController@index')->name('contestants.index');
    Route::get('/contestant/create', 'ContestantController@create')->name('contestant.create');

    Route::post('/images/upload', 'ImageController@store')->middleware('admin')->name('store.image');
});
