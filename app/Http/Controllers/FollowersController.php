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
        $idNotificacion = $request->get('idNotificacion');

        /* Seteo */
        $follower = new Follower();

        $follower->user_id = $usuarioLogin;
        $follower->seguido = $usuarioSeguido;

        $objetoFollower = User::find($usuarioSeguido);
        $objetoUserLogin = User::find($usuarioLogin);


        if ($solicitudAmistad == 1) {

            $solicitudEnviada = $follower->where('user_id', '=', $follower->seguido)->where('seguido', '=', $follower->user_id)->where('aprobada', '=', 0)->count();

            if ($solicitudEnviada == 1) {
                $idFollower = $follower->find($idFollower);
                $idFollower->aprobada = 1;
                $idFollower->save();
                $objetoFollower->notify(new SolicitudAceptadaNotification($objetoUserLogin, $idFollower));
                echo '<div class="alert alert-success text-center">Solicitud de Amistad Confirmada</div>';
            } else {
                echo '<div class="alert alert-danger text-center">Ya Aceptaste la Solicitud de Amistad</div>';
            }
            // Borro Notificacion
            $objetoUserLogin->unreadNotifications->where('id', $idNotificacion)->markAsRead();
        } else {

            $obtenerFollower = $follower->where('user_id', '=', $follower->user_id)->where('seguido', '=', $follower->seguido);

            $existeFollower = $obtenerFollower->count();

            if ($existeFollower > 0) {

                echo '<div class="alert alert-danger text-center">Ya Enviaste una Solicitud de Amistad</div>';
            } else {

                $follower->aprobada = 0;
                $follower->save();

                $solicitudFollower = $obtenerFollower->get();
                
                foreach ($solicitudFollower as $camposFollower) {
                    $objetoFollower->notify(new AgregarAmigoNotification($camposFollower));
                    // event(new AgregarAmigosNotificacion($camposFollower));
                }
                echo '<div class="alert alert-success text-center">Solicitud de Amistad Enviada</div>';
            };
        }
    }
}
