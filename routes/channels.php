<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


// Test private broadcast: $toUserId is provided in web.php route
Broadcast::channel('change-lang.{toUserId}', function ($user, $toUserId) {
    return (int) $user->id == (int) $toUserId;
});


Broadcast::channel('switch-profile.{userId}', function ($user, $userId) {
    // Verify that the user listens to his/her channel and that his/her $user->id matches with the $data['userId'] that was broadcasted.
    // If this returns true, the channel is authorized.
    return (int) $user->id == (int) $userId;
});


// Broadcast::channel('redirect-channel', function ($user) {
//     return !is_null($user);
// });

