<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// routes for Auth
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// routes for Admin (UPR/UPRA)
Route::prefix('admin')->name('admin.')->namespace('Admin')->middleware('auth')->group(function () {

    // flats routes
    Route::get('flats', 'FlatController@index')->name('flats.index');
    Route::get('flats/create', 'FlatController@create')->name('flats.create');
    Route::post('flats', 'FlatController@store')->name('flats.store');
    Route::get('flats/{slug}/edit', 'FlatController@edit')->name('flats.edit');
    Route::put('flats/{slug}', 'FlatController@update')->name('flats.update');
    Route::put('flats/status/{slug}', 'FlatController@update_status')->name('flats.update_status');
    Route::delete('flats/{slug}', 'FlatController@destroy')->name('flats.destroy');

    // messages routes
    Route::get('messages', 'MessageController@index')->name('messages.index');
    Route::get('messages/{id}', 'MessageController@show')->name('messages.show');
    Route::delete('messages/{id}', 'MessageController@destroy')->name('messages.destroy');

    // sponsorships routes
    Route::get('sponsorships', 'SponsorshipController@index')->name('sponsorships.index');
    Route::get('sponsorships/create', 'SponsorshipController@create')->name('sponsorships.create');
    Route::post('sponsorships', 'SponsorshipController@store')->name('sponsorships.store');

    // statistics route
    Route::get('statistics', 'ViewController@index')->name('statistics');
});


// routes for UI
Route::name('guest.')->namespace('Guest')->group(function () {

    // route for Homepage
    Route::get('/', 'HomepageController@index')->name('homepage');
    Route::get('/search', 'HomepageController@search')->name('homepage.search');

    // route for User
    Route::get('/users/{id}', 'UserController@show')->name('users.show');

    // route for Flats
    Route::get('/flats/{slug}', 'FlatController@show')->name('flats.show');


    //routes for message public
    Route::post('messages', 'MessageController@store')->name('messages.store');
    // Route::get('messages/create', 'MessageController@create')->name('messages.create');
    // Route::get('messages/{id}', 'MessageController@show')->name('messages.show');

});
