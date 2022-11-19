<?php

namespace App\Http\Controllers;

use Auth;
use Notification;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;
use App\Events\AgregarAmigosNotificacion;
use App\Notifications\AgregarAmigoNotification;
use App\Notifications\SolicitudAceptadaNotification;

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
        $solicitudAmistad = $request->get('solicitudAmistad');
        $idFollower = $request->get('idFollower');


        /* Seteo */
        $follower = new Follower();

        $follower->user_id = $usuarioLogin;
        $follower->seguido = $usuarioSeguido;

        $obtenerFollower = Follower::where('user_id', '=', $usuarioLogin)->where('seguido', '=', $usuarioSeguido);

        $objetoFollower = User::find($usuarioSeguido);
        $objetoUserLogin = User::find($usuarioLogin);

        if ($solicitudAmistad == 1) {

            $solicitudFollowerAceptada = Follower::find($idFollower);
         
            $solicitudFollowerAceptada->aprobada = 1;
            $solicitudFollowerAceptada->save();

            $solicitudFollower = $obtenerFollower->get();

                $objetoFollower->notify(new SolicitudAceptadaNotification($solicitudFollowerAceptada));
           
            // Usuario Seguido                                      //Usuario Autenticado
        } else {

            $existeFollower = $obtenerFollower->count();

            if ($existeFollower > 0) {

                // Ya Mandaste una Notificacion de Amistad
                echo 'Ya Mandaste una Notificacion de Amistad';
            } else {

                // echo 'envio de solicitud de Amistad';
                $follower->aprobada = 0;
                $follower->save();

                // Obtengo Fila de Solicitud en la Tabla Followers
                $solicitudFollower = $obtenerFollower->get();

                foreach ($solicitudFollower as $camposFollower) {
                    $objetoFollower->notify(new AgregarAmigoNotification($camposFollower));
                    // event(new AgregarAmigosNotificacion($camposFollower));
                }
                echo 1;
            };
        }
    }

    public function borrarContacto()
    {
        echo 'borrar contacto';
    }
}
