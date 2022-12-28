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

  public function save(Request $request)
  {
    $comentarioPublicacion = $request->input('comentPublication');
    $idPublicacionForm = $request->input('idPublication');
    $imagenPublicacion = $request->file('imagenPublication');

    // Instacio Objeto User
    $comments = new Comment();

    // Seteo Objeto
    $comments->user_id = Auth::user()->id;
    $comments->contenido = $comentarioPublicacion;
    $comments->publication_id = $idPublicacionForm;

    // Guardo Imagen en los Archivos, Seteo Objeto
    if ($imagenPublicacion) {

      // Nombre de la Imagen Original del Usuario y el Tiempo en que lo Sube
      $imagenPathName = time() . $imagenPublicacion->getClientOriginalName();

      //Guardo la Imagen en la carpeta del Proyecto
      Storage::disk('comments')->put($imagenPathName, File::get($imagenPublicacion));

      // Seteo el Objeto con el Nombre Original del Usuario
      $comments->imagen = $imagenPathName;
    }

    // Guardo
    $save = $comments->save();

    // Obtengo el Ultimo Id Guardado
    // $comments->id;

    if ($save) {

      $getComment = Comment::where('publication_id', '=', $idPublicacionForm)
        ->where('id', '=', $comments->id)
        ->get();

      $arrayListados = array();

      foreach ($getComment as $allComments) {
        array_push($arrayListados, $allComments);
      }

      return response()->json($arrayListados, 200, []);
    }
  }

  public function getImage($filename)
  {
    $file = Storage::disk('comments')->get($filename);
    return new Response($file, 200);
  }
}
