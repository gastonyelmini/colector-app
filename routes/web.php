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

Auth::routes();

//Recursos
Route::resource('/dnis', 'DniController');

//Rutas relacionadas con usuarios regulares
Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/faltantes', 'DniController@showMissings')->name('missings');

//Rutas relacionadas con administradores
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('admin');
Route::get('/cierres', 'AdminController@closings')->name('closings')->middleware('admin');

//Respuestas get
Route::get('/users/username', 'UserController@getAuthUser');
Route::get('/users/isloader', 'UserController@getisLoader');
Route::get('download-csv', function () {
	$dnis = \App\Dni::all();
	$csvExporter = new \Laracsv\Export();
	return $csvExporter->build($dnis, ['id', 'dni', 'name_lastname', 'address', 'created_at', 'updated_at', 'registed_by', 'school'])->download();
})->name('csv')->middleware('admin');
Route::get('reimport', 'DniController@reImportdata')->middleware('admin');
Route::get('remaining', 'DniController@getRemainingDnis')->middleware('auth');

Route::get('/closings', 'ClosingController@getClosings')->middleware('admin');

//Sector POST
Route::post('/closings', 'ClosingController@postClosing')->middleware('admin');


