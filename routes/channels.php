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

// Test private broadcast
// If returns true, then route is allawed
Broadcast::channel('private-change-lang.{toUserId}', function ($user, $toUserId) {
    info((int) $user->id);
    info((int) $toUserId);
    return (int) $user->id == (int) $toUserId;
});



// Broadcast::channel('redirect-channel', function ($user) {
//     return !is_null($user);
// });

