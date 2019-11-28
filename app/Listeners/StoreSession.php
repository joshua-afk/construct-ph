<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StoreSession
{
    public function __construct()
    {
        //
    }

    public function handle(UserLoggedIn $event)
    {
        session()->put([
            'user_id'             => $event->user->id,
            'user_code'           => $event->user->code,
            'user_email'          => $event->user->email,
            'user_username'       => $event->user->username,
            'user_first_name'     => $event->user->first_name,
            'user_last_name'      => $event->user->last_name,
            'user_type'           => $event->user->type,
            'user_image'          => $event->user->image,
            'user_session_token'  => $event->token,
        ]);
    }
}
