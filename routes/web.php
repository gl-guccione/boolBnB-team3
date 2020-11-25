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

// Route::get('/', function () {
//     return view('welcome');
// });

// routes for Auth
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// routes for Admin (UPR/UPRA)
Route::prefix('admin')->name('admin.')->namespace('Admin')->middleware('auth')->group(function () {

    // flats routes
    Route::resource('flats', 'FlatController');

    // messages routes
    Route::get('messages', 'RequestController@index')->name('messages.index');
    Route::get('messages/{id}', 'RequestController@show')->name('messages.show');
    Route::delete('messages/{id}', 'RequestController@destroy')->name('messages.destroy');

    // sponsorships routes
    Route::get('sponsorships', 'RequestController@index')->name('sponsorships.index');
    Route::get('sponsorships/{id}', 'RequestController@show')->name('sponsorships.show');
    Route::get('sponsorships/create', 'RequestController@create')->name('sponsorships.create');
    Route::post('sponsorships', 'RequestController@store')->name('sponsorships.store');


    // statistics route
    Route::get('flats/statistics', 'ViewController@index')->name('statistics');
});


// routes for UI
Route::name('guest.')->namespace('Guest')->group(function () {

    // route for Flats
    Route::get('/', 'FlatController@index')->name('flats.index');
    Route::get('/flats/{slug}', 'FlatController@show')->name('flats.show');

    // routes for message public
    Route::get('messages/create', 'RequestController@create')->name('messages.create');
    Route::post('messages', 'RequestController@store')->name('messages.store');
    Route::get('messages/{id}', 'RequestController@show')->name('messages.show');

});
