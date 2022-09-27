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

Broadcast::channel('item-has-bid-{user_id}', function ($user) {
    return true;
});

Broadcast::channel('notify-with-bid-{user_id}', function ($user) {
    return true;
});


Broadcast::channel('update-item', function ($user) {
    return true;
});


Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
