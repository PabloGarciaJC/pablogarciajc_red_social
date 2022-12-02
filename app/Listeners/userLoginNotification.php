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

        $todosFollower = Follower::select('followers.*')
            ->where('aprobada', '=', 1)
            ->Where('user_id', '=', $event->user->id)
            ->count();

        if ($todosFollower > 0) {

            $arrayListados = array();

            $todosFollower = Follower::select('followers.*')
                ->where('aprobada', '=', 1)
                ->Where('user_id', '=', $event->user->id)
                ->get();

            foreach ($todosFollower as $registrosFollower) {
                $user = User::find($registrosFollower->seguido);
                array_push($arrayListados, $user);
            }

            $usuarios = response()->json($arrayListados, 200, []);

            echo $usuarios;

        } else {

            $arrayListados = array();

            $todosFollower = Follower::select('followers.*')
                ->where('aprobada', '=', 1)
                ->Where('seguido', '=', $event->user->id)
                ->get();


            foreach ($todosFollower as $registrosFollower) {
                $user = User::find($registrosFollower->user_id);
                array_push($arrayListados, $user);
            }

            $usuarios = response()->json($arrayListados, 200, []);

            echo $usuarios;
        }

        broadcast(new UserSessionChanged($usuarios));
    }
}
