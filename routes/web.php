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
use Illuminate\Mail\Markdown;

Route::get('mail', function () {
    $markdown = new Markdown(view(), config('mail.markdown'));

    return $markdown->render('emails.confirmar-email', ['user'=>App\User::first(), 'logo'=>'logo']);
});
Route::get('test', 'TestController@test');
Route::get('lang/{route}/{language}', 'LanguageController@switchLang')->name('lang.switch');

Route::post('/images/upload', 'ImageController@store')->middleware('admin')->name('store.image');
Route::post('contest', 'ContestController@store')->middleware('admin')->name('contest.store');
Route::put('contest/{contest}', 'ContestController@update')->middleware('admin')->name('contest.update');

Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'localize'], // Route translate middleware

], function () {
    // Route::resource('contest', 'ContestController');
    Auth::routes();
    Route::redirect('/', 'the_contest');
    Route::get(LaravelLocalization::transRoute('routes.the_contest'), 'TheContestController@index')
    ->name('the_contest');
    Route::get('contests', 'ContestController@index')->middleware('admin')->name('contests.index');
    Route::get('contest', 'ContestController@create')->middleware('admin')->name('contests.index');
    Route::post('contest', 'ContestController@store')->middleware('admin')->name('contests.index');
    Route::get('contest/create', 'ContestController@create')->middleware('admin')->name('contest.create');
    Route::get('contest/{contest}', 'ContestController@show')->middleware('admin')->name('contest.show');
    Route::get('contest/{contest}/edit', 'ContestController@edit')->middleware('admin')->name('contest.edit');

    // Route::resource('contests', 'ContestController');

    Route::get('contest/{contest}/categories', 'CategoriesController@index')->middleware('admin')->name('categories');

    Route::get('/register/confirm', 'Auth\RegisterConfirmationController@index')->name('register.confirm');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::post('/profile', 'ProfileController@update')->name('profile.update');
    Route::post('/profile', 'ProfileController@index')->name('profile.index');
    Route::get('/mycontestants', 'MyContestantController@index')->name('mycontestants.index');
    Route::post('/mycontestant', 'MyContestantController@store')->middleware('auth')->name('mycontestant.store');
    Route::get('/mycontestants/{contestant}/edit', 'MyContestantController@edit')->name('mycontestants.edit');
    Route::put('/mycontestants/{contestant}', 'MyContestantController@update')->name('mycontestants.update');
    Route::get('/mycontestant/create', 'MyContestantController@create')->middleware('auth')->name('mycontestant.create');
    Route::post('/contestant/{contestant}/edit', 'ContestantController@edit')->name('contestant.edit');
    Route::put('/contestant/{contestant}', 'ContestantController@update')->name('contestant.update');
    Route::get('/contestants', 'ContestantController@index')->name('contestants.index');
});
