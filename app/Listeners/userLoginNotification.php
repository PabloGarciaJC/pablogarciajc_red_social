<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Auth\Events\Login;
use App\Events\UserSessionChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class userLoginNotification
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

    public function handle(login $event)
    {
        // Conectado Usuario
        $usuario = User::find($event->user->id);
        $usuario->conectado = 1;
        $usuario->save();

        // $usuarios = User::all();

        $usuarios = 'Inicia Sesion';

        broadcast(new UserSessionChanged($usuarios));
    }
}
