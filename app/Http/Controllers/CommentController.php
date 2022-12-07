<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\file;

class CommentController extends Controller
{
  public function guardar(Request $request)
  {
    $comentarioPublicacion = $request->input('comentarioPublicacion');
    $imagenPublicacion = $request->file('imagenPublicacion');

    // Instacio Objeto User
    $comments = new Comment();

    // Seteo Objeto
    $comments->user_id = Auth::user()->id;
    $comments->contenido = $comentarioPublicacion;

    // Guardo Imagen en los Archivos, Seteo Objeto
    if ($imagenPublicacion) {

      // Nombre de la Imagen Original del Usuario y el Tiempo en que lo Sube
      $imagenPathName = time() . $imagenPublicacion->getClientOriginalName();

      //Guardo la Imagen en la carpeta del Proyecto
      Storage::disk('comments')->put($imagenPathName, File::get($imagenPublicacion));

      // Seteo el Objeto con el Nombre Original del Usuario
      $comments->imagen = $imagenPathName;
    }

    $comments->save();

    return redirect()->route('home');
  }

  public function getImage($filename)
  {
    $file = Storage::disk('comments')->get($filename);
    return new Response($file, 200);
  }

}
