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
Route::get('lang/{route}/{language}', 'LanguageController@switchLang')->name('lang.switch');

Route::post('/images/upload', 'ImageController@store')->middleware('auth')->name('store.image');

Route::group([
    'prefix'     => '/admin',
    'middleware' => ['admin'], // Route admin

], function () {
    Route::get('users', 'UserController@index')->name('users.index');
    Route::get('users/{user}', 'UserController@toggleAdmin')->name('user.make.admin');
    Route::delete('users/{user}', 'UserController@destroy')->name('user.destroy');
    Route::get('/contestants', 'ContestantController@index')->name('contestants.index');
    Route::get('/contestant/create', 'ContestantController@create')->name('mycontestant.create');
    Route::post('/contestant/{contestant}/edit', 'ContestantController@edit')->name('contestant.edit');
    Route::put('/contestant/{contestant}', 'ContestantController@update')->name('contestant.update');
    Route::delete('/contestant/{contestant}', 'ContestantController@destroy')->name('contestant.destroy');
    Route::get('contests', 'ContestController@index')->name('contests.index');
    Route::get('contest/create', 'ContestController@create')->name('contest.create');
    Route::get('contest/{contest}', 'ContestController@show')->name('contest.show');
    Route::get('contest/{contest}/edit', 'ContestController@edit')->name('contest.edit');
    Route::get('contest/{contest}/categories', 'CategoriesController@index')->name('categories.index');
    Route::post('contest', 'ContestController@store')->name('contest.store');
    Route::put('contest/{contest}', 'ContestController@update')->name('contest.update');
});
Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'localize'], // Route translate middleware

], function () {
    // Route::resource('contest', 'ContestController');
    Auth::routes();
    Route::redirect('/', 'the_contest');
    Route::get(LaravelLocalization::transRoute('routes.the_contest'), 'TheContestController@index')
    ->name('the_contest');
    // Route::resource('contests', 'ContestController');

    Route::get('/register/confirm', 'Auth\RegisterConfirmationController@index')->name('register.confirm');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::post('/profile', 'ProfileController@update')->name('profile.update');
    Route::post('/profile', 'ProfileController@index')->name('profile.index');
    Route::get('/mycontestants', 'MyContestantController@index')->name('mycontestants.index');
    Route::get('/mycontestants/{contestant}/edit', 'MyContestantController@edit')->middleware('auth')->name('mycontestant.edit');
    Route::post('/mycontestant', 'MyContestantController@store')->middleware('auth')->name('mycontestant.store');
    Route::get('/mycontestant/create', 'MyContestantController@create')->middleware('auth')->name('mycontestant.create');
    Route::get('/mycontestant/{contestant}', 'MyContestantController@show')->name('mycontestant.show');
    Route::put('/mycontestant/{contestant}', 'MyContestantController@update')->middleware('auth')->name('mycontestant.update');
    Route::delete('/mycontestant/{contestant}', 'MyContestantController@destroy')->name('mycontestant.destroy');

    Route::get('/mycontestant/{contestant}/artwork-upload', 'ArtworkUploadController@create')->middleware('auth')->name('artwork.create');
    Route::post('/mycontestant/{contestant}/artwork-upload', 'ArtworkUploadController@store')->middleware('auth')->name('artwork.store');
    Route::put('/mycontestant/{contestant}/artwork-upload', 'ArtworkUploadController@update')->middleware('auth')->name('artwork.update');
    Route::get('/mycontestant/{contestant}/{artwork}/artwork-edit', 'ArtworkUploadController@edit')->middleware('auth')->name('artwork.edit');
    Route::put('/mycontestant/{contestant}/{artwork}/artwork-edit', 'ArtworkUploadController@update')->middleware('auth')->name('artwork.update');
    Route::get('/mycontestant/{contestant}/{artwork}/artwork-approve', 'ArtworkUploadController@approve')->middleware('auth')->name('artwork.approve');
    Route::get('/mycontestant/{contestant}/{artwork}/artwork-review', 'ArtworkUploadController@review')->middleware('auth')->name('artwork.review');
    Route::get('/gallery', 'GalleryController@index')->name('gallery.index');
});
