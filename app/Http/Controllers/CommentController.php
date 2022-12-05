<?php

namespace App\Http\Controllers;

use App\Models\Comment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function guardar(Request $request)
    {
      $comentarioPublicacion = $request->input('comentarioPublicacion');
      $imagenPublicacion = $request->file('imagenPublicacion');

    //Instacio Objeto User

    $comments = new Comment();

    $comments->user_id = Auth::user()->id;


    $comments->imagen_id = $imagenPublicacion;
    $comments->contenido =  $comentarioPublicacion;
  
    $comments->save();

    // Estar Pendiente 
    // Problema de Guardado
     
    }
}
