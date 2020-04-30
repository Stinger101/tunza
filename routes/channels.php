<?php

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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('user.{$user_id}', function ($user) {
    return $user->id === (int)$user_id;
});
Broadcast::channel('call.{$call}', function ($user, Call $call) {
    return $user->id === $call->caller_id||$user->id === $call->receiver_id?['id' => $user->id, 'name' => $user->name]:null;
});//when a user calls, they get a response of call_id that they can use to join channel,
//both leave channel at end of calls
//receiver receives notification of call from user.id private channel with call_id and they join channel
