<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('user.commands.{userId}', function ($user, $userId) {
    return $user->id == $userId;
});

