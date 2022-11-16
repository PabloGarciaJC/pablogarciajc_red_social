<?php

namespace App\Http\Controllers;

use Auth;
use Notification;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;
use App\Events\AgregarAmigosNotificacion;
use App\Notifications\AgregarAmigoNotification;

class FollowersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function agregarContacto(Request $request)
    {
        $usuarioLogin = $request->get('usuarioLogin');
        $usuarioSeguido = $request->get('usuarioSeguido');

        /* Seteo */
        $follower = new Follower();
        $follower->user_id = $usuarioLogin;
        $follower->seguido = $usuarioSeguido;
        $follower->aprobada = 0;

        $obtenerFollower = Follower::where('user_id', '=', $usuarioLogin)->where('seguido', '=', $usuarioSeguido);

        $existeFollower = $obtenerFollower->count();

        if ($existeFollower > 0) {
            echo 0;
        } else {

            $follower->save();
            // Obtengo Fila de Solicitud en la Tabla Followers
            $solicitudFollower = $obtenerFollower->get(); 

            $objetoFollower = User::find($usuarioSeguido);
            $objetoUserLogin = User::find($usuarioLogin);

            foreach ($solicitudFollower as $camposFollower) {
                $objetoFollower->notify(new AgregarAmigoNotification($camposFollower));
                // event(new AgregarAmigosNotificacion($camposFollower));
            }
            echo 1;
        }
    }


    public function borrarContacto()
    {
        echo 'borrar contacto';
    }
}
