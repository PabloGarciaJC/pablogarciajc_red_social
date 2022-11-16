<?php

namespace App\Listeners;

use App\Models\User;

use App\Events\UserSessionChanged;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\AgregarAmigosNotificacion;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AgregarAmigoNotification;
// use Notification;

class AgregarAmigosListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */

    /**
     * Handle the event.
     *
     * @param  object  $eventB
     * @return void
     */
    public function handle(AgregarAmigosNotificacion $event)
    {
        //  echo ($event->objetoFollower->created_at);
        //  echo ($event->objetoFollower->user->alias);
        // $usuarioEnvioNotificacion = User::find($event->objetoFollower->seguido);
        // $usuarioEnvioNotificacion->notify(new AgregarAmigoNotification($event->objetoFollower));
        // broadcast(new AgregarAmigosNotificacion($event->objetoFollower->created_at));
    }
}
