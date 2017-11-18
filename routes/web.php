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

Route::get('/', 'HomeController@showVenues');

Auth::routes();


Route::get('/venues', 'HomeController@showVenues')->name('venues');
Route::get('/venues/add', 'HomeController@showAddVenue')->name('show_add_venues');
Route::get('/venues/{id}', 'HomeController@showEditVenue')->name('show_edit_venue');
Route::post('/venue', 'HomeController@addVenue');
Route::post('/venues/{id}', 'HomeController@editVenue');
Route::delete('/venues/{id}', 'HomeController@deleteVenue');
Route::post('/venues/{id}/confirm', 'HomeController@confirmVenue');
Route::get('/venues/export/{type}', 'HomeController@exportVenues')->name('export_venues');
