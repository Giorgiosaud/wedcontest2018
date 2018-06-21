<?php

namespace App\Listeners;

use App\Events\RegisterContestant;
use App\Mail\ContestantRegistered;
use Illuminate\Support\Facades\Mail;

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
     * @param RegisterContestant $event
     *
     * @return void
     */
    public function handle(RegisterContestant $event)
    {
        $user = $event->user;
        $contestant = $event->contestant;

        return Mail::to('wedcontest@diproinduca.com')->send(new ContestantRegistered($user, $contestant));
        //
    }
}
