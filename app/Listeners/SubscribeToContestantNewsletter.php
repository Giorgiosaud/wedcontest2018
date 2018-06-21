<?php

namespace App\Listeners;

use App\Events\RegisterContestant;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class SubscribeToContestantNewsletter
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
        Newsletter::subscribe($contestant->email, [
            'FNAME'    => $contestant->name,
            'LNAME'    => $contestant->last_name,
            'CATEGORY'    => $contestant->activeCategory,
        ],'contestants');
        //
    }
}
