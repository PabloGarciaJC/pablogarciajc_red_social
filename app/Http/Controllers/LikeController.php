<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\file;

class LikeController extends Controller
{
    public function save($idPublicacion)
    {

        $like = Like::where('user_id', Auth::user()->id)
            ->where('publication_id', $idPublicacion);

        $conteoLikes = $like->count();

        if ($conteoLikes == 0) {

            $like = new Like();
            $like->user_id = Auth::user()->id;
            $like->publication_id = (int)$idPublicacion;

            $like->save();

            return response()->json([
                'like' => $like
            ]);
            
        } else {
            return response()->json([
                'message' => 'El like ya existe'
            ]);
        }
    }
}
