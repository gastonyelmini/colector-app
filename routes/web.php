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
Route::get('/closings', 'ClosingController@getClosings')->middleware('admin');

//Rutas relacionadas con administradores
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('admin');
Route::get('/cierres', 'AdminController@closings')->name('closings')->middleware('admin');

//Respuestas get
Route::get('/users/username', 'UserController@getAuthUser');
Route::get('download-csv', function () {
	$dnis = \App\Dni::all();
	$csvExporter = new \Laracsv\Export();
	return $csvExporter->build($dnis, ['id', 'dni', 'created_at', 'updated_at', 'registed_by'])->download();
})->name('csv')->middleware('admin');

//Sector POST
Route::post('/closings', 'ClosingController@postClosing')->middleware('admin');


