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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'WelcomeController@index');

// Auth::routes();
// Auth::routes(['verify' => true]);

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/mail', 'TestMailController@send');

Route::get('todayevent', 'WelcomeController@searchToday')->name('todayevent');
Route::get('tomorrowevent', 'WelcomeController@searchTomorrow')->name('tomorrowevent');
Route::get('weekendevent', 'WelcomeController@searchWeekend')->name('weekendevent');
Route::get('eventdetail/{id}', 'EventController@show')->name('eventdetail');
Route::get('eventgenre/{genre_id}', 'EventController@genre')->name('eventgenre');

Route::post('eventedit', 'EventController@register')->name('eventedit');
