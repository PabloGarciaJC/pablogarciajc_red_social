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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// USUARIO
Route::get('/configuracion', 'UserController@configuracion')->name('configuracion');
Route::post('/actualizar', 'UserController@actualizar')->name('actualizar');
Route::get('/fotoPerfil/{filename}', 'UserController@getImage')->name('foto.perfil');
Route::get('/search', 'UserController@search')->name('search');
Route::get('/{obtenerUsuario}', 'UserController@obtenerUsuario')->name('obtenerUsuario');

// Route::get('test', function () {
//   event(new App\Events\MyEvent('hello world'));
// return "El evento ha sido enviado";
// });


