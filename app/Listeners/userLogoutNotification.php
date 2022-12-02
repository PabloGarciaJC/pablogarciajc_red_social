<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Login;
use App\Events\UserSessionChanged;
use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class userLogoutNotification
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

    public function handle(logout $event)
    {
        $usuario = User::find($event->user->id);
        $usuario->conectado = 0;
        $usuario->save();
        
        // $usuarios = User::all();

        $usuarios = 'cerro sesion';

        broadcast(new UserSessionChanged($usuarios));
    }
}
