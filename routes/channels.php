<?php

use App\Models\User;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('App.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

/* Para el Canal Privado */
// Broadcast::channel('notifications', function ($user) {
//     return $user != null;
// });


Broadcast::channel('chat', function (User $user) {
  if ($user != null) {
    return ['id' => $user->id, 'name' => $user->nombre];
  }
  
});


// Broadcast::channel('chat.{roomId}', function ($user, $roomId) {
//   if ($user->canJoinRoom($roomId)) {
//       return ['id' => $user->id, 'name' => $user->name];
//   }
// });
