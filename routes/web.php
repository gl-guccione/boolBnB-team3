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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//routes for UPR/UPRA
Route::prefix('admin')->name('admin.')->namespace('Admin')->middleware('auth')->group(function () {
    //home = index flats
    // Route::get('/', 'HomeController@index')->name('home');

    //flats routes
    Route::resource('flats', 'FlatController');
    
    //requests routes
    // Route::resource('requests', 'RequestController');
    Route::get('requests', 'RequestController@index')->name('requests.index');
    Route::get('requests/{id}', 'RequestController@show')->name('requests.show');
    Route::get('requests', 'RequestController@store')->name('requests.store');
    Route::get('requests/{request}', 'RequestController@destroy')->name('requests.destroy');
    Route::get('requests/create', 'RequestController@create')->name('requests.create');
    
    //sponsorships routes
    Route::get('sponsorships', 'RequestController@index')->name('sponsorships.index');
    Route::get('sponsorships/{id}', 'RequestController@show')->name('sponsorships.show');
    Route::get('sponsorships', 'RequestController@store')->name('sponsorships.store');
    Route::get('sponsorships/create', 'RequestController@create')->name('sponsorships.create');
    

    //statistic route
    Route::get('flats/stat', 'ViewController@index')->name('view');
});


//routes for UI
Route::name('guest.')->namespace('Guest')->group(function () {
    Route::get('/flats', 'FlatController@index')->name('flat.index');
    Route::get('/flats/{slug}', 'FlatController@show')->name('flat.show');


});
