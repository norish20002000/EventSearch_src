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
Route::get('request', 'WelcomeController@request')->name('request');
Route::get('company', 'WelcomeController@company')->name('company');
Route::get('alliance', 'WelcomeController@alliance')->name('alliance');
Route::get('eventdetail/{id}', 'EventController@show')->name('eventdetail');
Route::get('eventgenre/{genre_id}', 'EventController@genre')->name('eventgenre');

Route::get('eventbank/event/edit/{id?}', 'EventBankController@edit')->name('eventedit');
Route::post('/eventbank/event/register', 'EventBankController@register')->name('eventregister');
Route::get('/eventbank/event/ope', 'EventBankController@showList')->name('eventopelist');
Route::get('/eventbank/event/export', 'EventBankController@exportCsv')->name('eventexport');
Route::get('/eventbank/event/export/csv', 'EventBankController@exportCsvList')->name('eventexportlist');


Route::get('debug', 'EventBankController@getData');

// debub
Route::get('/debug', 'EventBankController@getDataBySearch');