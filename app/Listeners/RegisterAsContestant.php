<?php

namespace App\Listeners;

use App\Events\RegisterContestant;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterAsContestant
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
     * @param  RegisterContestant  $event
     * @return void
     */
    public function handle(RegisterContestant $event)
    {
        //
    }
}
