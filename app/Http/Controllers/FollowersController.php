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
use App\Notifications\SolicitudCanceladaNotification;

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
        $followerAprobado = $request->get('followerAprobado');
        $idNotificacion = $request->get('idNotificacion');
        $objetoUserLoginEnviar = User::find($usuarioLogin);
        $objetoFollowerRecibir = User::find($usuarioSeguido);

        $follower = new Follower();

        if ($idNotificacion === '0') {

            $registerFollowerSend = $follower->where('user_id', '=', $objetoUserLoginEnviar->id)->where('seguido', '=', $objetoFollowerRecibir->id)->where('aprobada', '=', 0);

            if ($registerFollowerSend->count() == 0) {

                $follower->user_id = $objetoUserLoginEnviar->id;
                $follower->seguido = $objetoFollowerRecibir->id;
                $follower->aprobada = 0;

                $objetoFollowerRecibir->notify(new AgregarAmigoNotification($objetoFollowerRecibir, $objetoUserLoginEnviar));

                $follower->save();

                echo 'send';
            } else {

                echo 'existSend';
            }
        } else {

            $sendAfterReceived = $follower->where('user_id', '=', $objetoFollowerRecibir->id)->where('seguido', '=', $objetoUserLoginEnviar->id);

            if ($sendAfterReceived->count() == 0) {

                $saveReceivedAfterReceived = $follower->where('user_id', '=', $objetoUserLoginEnviar->id)->where('seguido', '=', $objetoFollowerRecibir->id);

                if ($saveReceivedAfterReceived->count() == 0) {

                    $follower->user_id = $objetoFollowerRecibir->id;;
                    $follower->seguido = $objetoUserLoginEnviar->id;
                    $follower->aprobada = 0;

                    $objetoFollowerRecibir->notify(new AgregarAmigoNotification($objetoFollowerRecibir, $objetoUserLoginEnviar));

                    $follower->save();

                    echo 'sendAfterReceived';
                } else {

                    foreach ($saveReceivedAfterReceived->get() as $registerFollower) {
                        $follower = $follower->find($registerFollower->id);
                        $follower->aprobada = 1;
                        $follower->save();
                    }

                    $objetoFollowerRecibir->notify(new SolicitudAceptadaNotification($objetoUserLoginEnviar, $objetoFollowerRecibir));

                    echo 'saveReceivedAfterReceived';
                }
            } else {

                $objetoFollowerRecibir->notify(new SolicitudAceptadaNotification($objetoUserLoginEnviar, $objetoFollowerRecibir));
                foreach ($sendAfterReceived->get() as $follower) {
                    $follower = $follower->find($follower->id);
                    $follower->aprobada = 1;
                    $follower->save();
                }
                echo 'saveAfterReceivedFriends';
            }
        }

        die();


        // } else {

        //     echo 'saveAfterReceived';

        //     $sendAfterReceived = $follower->where('user_id', '=', $objetoFollowerRecibir->id)->where('seguido', '=', $objetoUserLoginEnviar->id)->where('aprobada', '=', 0);

        //     if ($sendAfterReceived->count() == 1) {

        //         $objetoFollowerRecibir->notify(new SolicitudAceptadaNotification($objetoUserLoginEnviar, $objetoFollowerRecibir));

        //         foreach ($sendAfterReceived->get() as $follower) {
        //             $borrarRegistroFollower = $follower->find($follower->id);
        //             $borrarRegistroFollower->aprobada = 1;
        //             $borrarRegistroFollower->save();
        //         }

        //         echo 'saveAfterReceived';

        //     } else {

        //         $afterReceived = $follower->where('user_id', '=', $objetoUserLoginEnviar->id)->where('seguido', '=', $objetoFollowerRecibir->id)->where('aprobada', '=', 0);

        //         if ($afterReceived->count() == 1) {

        //             foreach ($afterReceived->get() as $follower) {
        //                 $borrarRegistroFollower = $follower->find($follower->id);
        //                 $borrarRegistroFollower->aprobada = 1;
        //                 $borrarRegistroFollower->save();
        //             }

        //             echo 'saveAfterReceived';

        //         } else {

        //             $follower->user_id = $objetoFollowerRecibir->id;
        //             $follower->seguido = $objetoUserLoginEnviar->id;
        //             $follower->aprobada = 0;

        //             $objetoFollowerRecibir->notify(new AgregarAmigoNotification($objetoFollowerRecibir, $objetoUserLoginEnviar));

        //             $follower->save();

        //             echo 'sendAfterReceived';
        //         }
        //     }
        // }
    }

    // $objetoFollowerRecibir->notify(new AgregarAmigoNotification($objetoFollowerRecibir, $objetoUserLoginEnviar));
    // $follower->user_id = $objetoUserLoginEnviar->id;
    // $follower->seguido = $objetoFollowerRecibir->id;
    // $follower->aprobada = 0;
    // $follower->save();
    // echo 'send';




    // else {

    //     $addAfterReceiving = $follower->where('user_id', '=', $objetoFollowerRecibir->id)->where('seguido', '=', $objetoUserLoginEnviar->id)->where('aprobada', '=', 0);

    //     if ($addAfterReceiving->count() == 1) {

    //         $objetoFollowerRecibir->notify(new SolicitudAceptadaNotification($objetoUserLoginEnviar, $objetoFollowerRecibir));

    //         foreach ($addAfterReceiving->get() as $follower) {
    //             $borrarRegistroFollower = $follower->find($follower->id);
    //             $borrarRegistroFollower->aprobada = 1;
    //             $borrarRegistroFollower->save();
    //         }
    //     } else {

    //         $follower->user_id = $objetoFollowerRecibir->id;
    //         $follower->seguido = $objetoUserLoginEnviar->id;
    //         $follower->aprobada = 1;

    //         $follower->save();
    //     }

    //     echo 'addAfterReceiving';
    // }

    public function cancelarContacto(Request $request)
    {
        $usuarioLogin = $request->get('usuarioLogin');
        $usuarioSeguido = $request->get('usuarioSeguido');
        $idNotificacion = $request->get('idNotificacion');

        $objetoUserLoginEnviar = User::find($usuarioLogin);
        $objetoFollowerRecibir = User::find($usuarioSeguido);

        $follower = new Follower();

        if ($idNotificacion === '0') {

            //  Obtengo las Notificaciones del Usuario
            $notifications = $objetoFollowerRecibir->notifications;

            //  Borro las Notificaciones que vienen en Json y Comparo con los informacion que tengo.
            foreach ($notifications as $clave => $value) {
                if ($value['data']['alias'] == $objetoUserLoginEnviar->alias && $value['data']['idFollowerRecibir'] == $objetoFollowerRecibir->id) {
                    DB::table('notifications')->whereId($value['id'])->delete();
                }
            }

            // Borro Registro de Follower
            $registerFollowerSend = $follower->where('user_id', '=', $objetoUserLoginEnviar->id)->where('seguido', '=', $objetoFollowerRecibir->id);
            foreach ($registerFollowerSend->get() as $follower) {
                $borrarDeleteFollower = $follower->find($follower->id);
                $borrarDeleteFollower->delete();
            }

            echo 'sendCancelar';
        } else {

            $sendAfterReceived = $follower->where('user_id', '=', $objetoFollowerRecibir->id)->where('seguido', '=', $objetoUserLoginEnviar->id);

            if ($sendAfterReceived->count() == 1) {

                foreach ($sendAfterReceived->get() as $follower) {
                    $borrarDeleteFollower = $follower->find($follower->id);
                    $borrarDeleteFollower->delete();
                }

                $objetoFollowerRecibir->notify(new SolicitudCanceladaNotification($objetoUserLoginEnviar, $objetoFollowerRecibir));

                echo 'cancelAfterReceived';
            } else {

                $showFollower = $follower->where('user_id', '=', $objetoUserLoginEnviar->id)->where('seguido', '=', $objetoFollowerRecibir->id);

                if ($showFollower->count() == 1) {

                    foreach ($showFollower->get() as $showRegister) {

                        $borrarDeleteFollower = $follower->find($showRegister->id);
                        $borrarDeleteFollower->delete();
                    }

                    echo 'deleteReceivedAfterReceived';

                    $objetoFollowerRecibir->notify(new SolicitudCanceladaNotification($objetoUserLoginEnviar, $objetoFollowerRecibir));
                } else {

                    echo 'existAfterReceived';
                }
            }
        }




        // else {

        //     $obtenerFollower = $follower->where('user_id', '=', $objetoFollowerRecibir->id)->where('seguido', '=', $objetoUserLoginEnviar->id);

        //     if ($obtenerFollower->count() == 1) {
        //         DB::table('notifications')->whereId($idNotificacion)->delete();

        //         $objetoFollowerRecibir->notify(new SolicitudCanceladaNotification($objetoUserLoginEnviar, $objetoFollowerRecibir));

        //         foreach ($obtenerFollower->get() as $follower) {

        //             $borrarDeleteFollower = $follower->find($follower->id);
        //             $borrarDeleteFollower->delete();

        //             echo 'receivedCancelar';
        //         }
        //     }

        //     $deleteAfterAdd = $follower->where('user_id', '=', $objetoUserLoginEnviar->id)->where('seguido', '=', $objetoFollowerRecibir->id);

        //     if ($deleteAfterAdd->count() == 1) {
        //         DB::table('notifications')->whereId($idNotificacion)->delete();

        //         $objetoFollowerRecibir->notify(new SolicitudCanceladaNotification($objetoUserLoginEnviar, $objetoFollowerRecibir));

        //         foreach ($deleteAfterAdd->get() as $follower) {

        //             $borrarDeleteFollower = $follower->find($follower->id);
        //             $borrarDeleteFollower->delete();

        //             echo 'receivedCancelar';
        //         }
        //     }
        // }
    }

    public function btnValidarAmistad(Request $request)
    {
        $usuarioLogin = $request->get('usuarioLogin');
        $usuarioSeguido = $request->get('usuarioSeguido');

        $follower = new Follower();

        // Send
        $existeAmistad = $follower->where('user_id', '=', $usuarioLogin)->where('seguido', '=', $usuarioSeguido);

        if ($existeAmistad->count() == 0) {
            echo 'sendAgregarContacto';
        } else {
            echo 'sendCancelarContacto';
        }


        // else {

        // el que recibe

        // $addAfterReceiving = $follower->where('user_id', '=', $usuarioSeguido)->where('seguido', '=', $usuarioLogin)->where('aprobada', '=', 0);

        // if ($addAfterReceiving->count() == 1) {
        //     echo 'sendAgregarContacto';
        // } else {
        //     echo 'sendCancelarContacto';
        // }


        // $addAfterReceiving = $follower->where('user_id', '=', $usuarioSeguido)->where('seguido', '=', $usuarioLogin)->where('aprobada', '=', 1);

        // if ($addAfterReceiving->count() == 1) {
        //     echo 'sendCancelarContacto';
        // }else{
        //     echo 'sendAgregarContacto';
        // }

        // //received
        // $addAfterReceiving = $follower->where('user_id', '=', $usuarioSeguido)->where('seguido', '=', $usuarioLogin)->where('aprobada', '=', 0);

        // // echo $addAfterReceiving->count();
        // if ($addAfterReceiving->count() == 0) {

        //     $tes = $follower->where('user_id', '=', $usuarioLogin)->where('seguido', '=', $usuarioSeguido)->where('aprobada', '=', 1)->count();

        //     if ($tes == 1) {

        //         echo 'sendCancelarContacto';

        //     } else {

        //         echo 'receivedCancelarContacto';
        //     }

        // } else {

        //     echo 'receivedAgregarContacto';
        // }

        // $afterReceiving = $follower->where('user_id', '=', $usuarioLogin)->where('seguido', '=', $usuarioSeguido)->where('aprobada', '=', 1);

        // echo $afterReceiving->count();

        // if ($afterReceiving->count() == 1) {
        //     echo 'receivedAgregarContacto';
        // }

        // if ($addAfterReceiving->count() == 0) {
        //     echo 'receivedAgregarContacto';
        // } else {
        //     echo 'receivedCancelarContacto';
        // }

        // }
    }
}
