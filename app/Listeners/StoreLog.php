<?php

namespace App\Listeners;

use App\Events\EventLogged;
use App\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StoreLog
{
    public function __construct()
    {
        //
    }

    public function handle(EventLogged $event)
    {
        Log::create([
            'user_id'     => $event->user_id,
            'type'        => $event->type,
            'description' => $event->description,
            'created_at'  => now('Asia/Manila'),
            'updated_at'  => now('Asia/Manila'),
        ]);
    }
}
