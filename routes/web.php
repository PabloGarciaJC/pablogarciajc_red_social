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
Route::get('/perfil', 'UserController@perfil')->name('perfil');
Route::post('/actualizar', 'UserController@actualizar')->name('actualizar');
Route::get('/fotoPerfil/{filename}', 'UserController@getImage')->name('foto.perfil');
Route::get('/usuario/{perfil}/{solicitudAmistad?}/{idFollower?}/{idNotificacion?}', 'UserController@buscadorPerfil')->name('usuarioBuscador.perfil');
Route::get('/search', 'UserController@search')->name('search');

// FOLLOWERS
Route::get('/agregarContacto', 'FollowersController@agregarContacto')->name('agregarContacto');
Route::get('/cancelarContacto', 'FollowersController@cancelarContacto')->name('cancelarContacto');
Route::get('/btnValidarAmistad', 'FollowersController@btnValidarAmistad')->name('btnValidarAmistad');

// COMMENTS
Route::post('/comentarioSave', 'CommentController@save')->name('comentarioSave');
// Route::get('/imagenPublicacion/{filename}', 'CommentController@getImage')->name('imagenPublicacion');


// PUBLICACIONES
Route::post('/publicationSave', 'PublicationController@save')->name('publicationSave');
Route::get('/publicationImagen/{filename}', 'PublicationController@getImage')->name('publicationImagen');


// Route::get('/prueba', 'UserController@prueba')->name('prueba');




// NOTIFICACIONES
Route::get('markAsRead', function () {
  auth()->user()->unreadNotifications->markAsRead();
  return redirect()->back();
})->name('markAsRead');

Route::get('borrarNotificacion/{id}', function ($id) {
  $usuarioLogin = Auth::user()->find($id);
  $usuarioLogin->notifications()->delete();
  return redirect()->back();
})->name('borrarNotificacion');



// Route::get('markAsReadDelete', function () {
//   auth()->user()->notifications()->delete();
//   return redirect()->back();
// })->name('markAsReadDelete');


// Route::get('test', function () {
//   event(new App\Events\MyEvent('hello world'));
// return "El evento ha sido enviado";
// });
