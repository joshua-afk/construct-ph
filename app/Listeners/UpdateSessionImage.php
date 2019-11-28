<?php

namespace App\Listeners;

use App\Events\UserImageChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateSessionImage
{
    public function __construct()
    {
        //
    }


    public function handle(UserImageChanged $event)
    {
        session()->put('user_image', $event->user->image);
    }
}
