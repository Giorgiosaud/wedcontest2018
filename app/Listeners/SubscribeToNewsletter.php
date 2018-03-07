<?php

namespace App\Listeners;

use App\Events\RegisterRepresentant;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
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
     * @param  RegisterRepresentant  $event
     * @return void
     */
    public function handle(RegisterRepresentant $event)
    {
        Newsletter::subscribe($event->user->email);

    }
}
