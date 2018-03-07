<?php

namespace App\Listeners;

use App\Events\RegisterRepresentant;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterAsRepresentant
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
     * @param  RegisterRepresentant  $event
     * @return void
     */
    public function handle(RegisterRepresentant $event)
    {
     $event->user->
    }
}
