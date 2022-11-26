<?php

namespace App\Http\Controllers;

use Auth;
use Notification;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    // public function agregarContacto(Request $request)
    // {

    //     $usuarioLogin = $request->get('usuarioLogin');
    //     $usuarioSeguido = $request->get('usuarioSeguido');
    //     $solicitudAmistad = $request->get('solicitudAmistad');
    //     $idFollower = $request->get('idFollower');
    //     $idNotificacion = $request->get('idNotificacion');

    //     /* Seteo */
    //     $follower = new Follower();

    //     $follower->user_id = $usuarioLogin;
    //     $follower->seguido = $usuarioSeguido;

    //     $objetoFollower = User::find($usuarioSeguido);
    //     $objetoUserLogin = User::find($usuarioLogin);


    //     if ($solicitudAmistad == 1) {

    //         $solicitudEnviada = $follower->where('user_id', '=', $follower->seguido)->where('seguido', '=', $follower->user_id)->where('aprobada', '=', 0)->count();

    //         if ($solicitudEnviada == 1) {
    //             $idFollower = $follower->find($idFollower);
    //             $idFollower->aprobada = 1;
    //             $idFollower->save();
    //             $objetoFollower->notify(new SolicitudAceptadaNotification($objetoUserLogin, $idFollower));

    //             echo '<div class="alert alert-success text-center">Solicitud de Amistad Confirmada</div>';

    //         } else {
    //             echo '<div class="alert alert-danger text-center">Ya Aceptaste la Solicitud de Amistad</div>';
    //         }

    //         // Borro Notificacion
    //         $objetoUserLogin->unreadNotifications->where('id', $idNotificacion)->markAsRead();

    //     } else {

    //         $obtenerFollower = $follower->where('user_id', '=', $follower->user_id)->where('seguido', '=', $follower->seguido);

    //         $existeFollower = $obtenerFollower->count();

    //         if ($existeFollower > 0) {

    //             echo '<div class="alert alert-danger text-center">Ya Enviaste una Solicitud de Amistad</div>';
    //         } else {

    //             $follower->aprobada = 0;
    //             $follower->save();

    //             $solicitudFollower = $obtenerFollower->get();

    //             foreach ($solicitudFollower as $camposFollower) {
    //                 $objetoFollower->notify(new AgregarAmigoNotification($camposFollower));
    //                 // event(new AgregarAmigosNotificacion($camposFollower));
    //             }
    //             echo '<div class="alert alert-success text-center">Solicitud de Amistad Enviada</div>';
    //         };
    //     }
    // }

    public function agregarContacto(Request $request)
    {
        $usuarioLogin = $request->get('usuarioLogin');
        $usuarioSeguido = $request->get('usuarioSeguido');
        $idNotificacion = $request->get('idNotificacion');
        $solicitudAmistad = $request->get('solicitudAmistad');
        $idRegistroFollower = $request->get('idRegistroFollower');

        $follower = new Follower();

        $follower->user_id = $usuarioLogin;
        $follower->seguido = $usuarioSeguido;

        $objetoFollower = User::find($usuarioSeguido);
        $objetoUserLogin = User::find($usuarioLogin);

        if ($solicitudAmistad == 1) {

            $regitroFollower = $follower->where('user_id', '=', $follower->seguido)->where('seguido', '=', $follower->user_id)->where('aprobada', '=', 0)->count();

            if ($regitroFollower > 0) {
                // El que Recibe
                $registroFollower = Follower::find($idRegistroFollower);
                $registroFollower->aprobada = 1;
                $registroFollower->save();
                DB::table('notifications')->whereId($idNotificacion)->delete();
                // $objetoUserLogin->unreadNotifications->where('id', $idNotificacion)->markAsRead();
                // Envio la Notificacion que se ha aceptado la Solicitud                
                $objetoFollower->notify(new SolicitudAceptadaNotification($objetoUserLogin, $registroFollower));

            } else {
                // El que Guarda despues de recibir
                $follower->aprobada = 1;
                $guardado = $follower->save();

                if ($guardado) {

                    $regitroFollower = $follower->where('user_id', '=', $usuarioLogin)->where('seguido', '=', $usuarioSeguido)->where('aprobada', '=', 1)->get();

                    foreach ($regitroFollower as $camposFollower) {
                        $objetoFollower->notify(new SolicitudAceptadaNotification($objetoUserLogin, $camposFollower));
                    }

                    echo 'solicitudEnviada';
                }
            }
        } else {

            // El que Envia
            $obtenerFollower = $follower->where('user_id', '=', $follower->user_id)->where('seguido', '=', $follower->seguido);

            $existeFollower = $obtenerFollower->count();

            if ($existeFollower > 0) {

                false;
            } else {

                // Seteo Objeto
                $follower->aprobada = 0;

                // Guardo
                $follower->save();

                // Envio Notificacion
                $solicitudFollower = $obtenerFollower->get();

                foreach ($solicitudFollower as $camposFollower) {
                    $objetoFollower->notify(new AgregarAmigoNotification($camposFollower));
                }

                // Guardo Notificacion en la Entidad Followers
                $notifications = $objetoFollower->notifications;

                foreach ($notifications as $notification) {
                    $follower->notification_id = $notification->id;
                    $follower->save();
                }

                echo 'solicitudEnviada';
            };
        }
    }

    public function cancelarContacto(Request $request)
    {
        $usuarioLogin = $request->get('usuarioLogin');
        $usuarioSeguido = $request->get('usuarioSeguido');
        $idNotificacion = $request->get('idNotificacion');
        $solicitudAmistad = $request->get('solicitudAmistad');

         $follower = new Follower();

        $follower->user_id = $usuarioLogin;
        $follower->seguido = $usuarioSeguido;

        $objetoFollower = User::find($usuarioSeguido);
        $objetoUserLogin = User::find($usuarioLogin);

        if ($solicitudAmistad == 1) {

            // El que Recibe
            $obtenerFollower = $follower->where('user_id', '=', $usuarioSeguido)->where('seguido', '=', $usuarioLogin)->get();

            foreach ($obtenerFollower as $camposFollower) {
                $borrarDeleteFollower = $follower->find($camposFollower->id);
                $borrarDeleteFollower->delete();
            }

            foreach ($objetoFollower->unReadNotifications as $notification) {
                DB::table('notifications')->whereId($notification->id)->delete();
            }

            // El que Cancela despues de recibir
            $obtenerFollowerEnviar = $follower->where('user_id', '=', $usuarioLogin)->where('seguido', '=', $usuarioSeguido)->get();
            foreach ($obtenerFollowerEnviar as $camposFollower) {
                $borrarDeleteFollower = $follower->find($camposFollower->id);
                $borrarDeleteFollower->delete();
            }

            foreach ($objetoUserLogin->unReadNotifications as $notification) {
                DB::table('notifications')->whereId($notification->id)->delete();
            }
            
            echo 1;

        } else {

            // El que Envia
            $obtenerFollower = $follower->where('user_id', '=', $follower->user_id)->where('seguido', '=', $follower->seguido);

            $recorrerCamposFollower = $obtenerFollower->get();

            foreach ($recorrerCamposFollower as $recorrerCampos) {
                // $objetoFollower->unreadNotifications->where('id', $recorrerCampos->notification_id)->markAsRead();
                DB::table('notifications')->whereId($recorrerCampos->notification_id)->delete();
                $borrarDeleteFollower = $follower->find($recorrerCampos->id);
                $borrarDeleteFollower->delete();
                echo 1;
            }
        }
    }

    public function btnValidarAmistad(Request $request)
    {
        $usuarioLogin = $request->get('usuarioLogin');
        $usuarioSeguido = $request->get('usuarioSeguido');
        $solicitudAmistad = $request->get('solicitudAmistad');

        $follower = new Follower();

        if ($solicitudAmistad == 1) {

            // El que Recibe
            $recibeSolicitud = $follower->where('user_id', '=', $usuarioSeguido)->where('seguido', '=', $usuarioLogin)->get();
            foreach ($recibeSolicitud as $recibeCamposFollower) {
                echo $recibeCamposFollower->aprobada;
            }

            // El que Envia al Recibir
            $envioSolicitud = $follower->where('user_id', '=', $usuarioLogin)->where('seguido', '=', $usuarioSeguido)->get();
            foreach ($envioSolicitud as $envioCamposFollower) {
                echo $envioCamposFollower->aprobada;
            }
        } else {

            // El que Envia
            $obtenerFollower = $follower->where('user_id', '=', $usuarioLogin)->where('seguido', '=', $usuarioSeguido);
            $existeAmistad = $obtenerFollower->count();
            if ($existeAmistad > 0) {
                // No Existe Amistad
                echo 1;
            } else {
                // Si Existe Amistad
                echo 0;
            }
        }
    }
}
