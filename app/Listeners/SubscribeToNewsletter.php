<?php

namespace App\Listeners;

use App\Events\RegisterRepresentant;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class SubscribeToNewsletter
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
     * @param RegisterRepresentant $event
     *
     * @return void
     */
    public function handle(RegisterRepresentant $event)
    {
        $user = $event->user;
        Newsletter::subscribe($user->email, [
            'FNAME' => $user->name,
            'LNAME' => $user->last_name,
            'PHONE' => $user->phone,
            'REFERRED' => $user->referred,
            'COUNTRY' => $user->country,
            'LANGUAGE' => $user->language,
        ]);
    }
}
