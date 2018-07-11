<?php

namespace App\Listeners;

use App\Events\RegisterRepresentant;
use App\Mail\PleaseConfirmYourEmail;
use App\Mail\PorFavorConfirmeSuCorreo;
use Illuminate\Support\Facades\Mail;

class SendEmail
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
//        dd($event->user);
        $user = $event->user;
        switch ($user->language) {
            case 'en':
                Mail::to($user)->send(new PleaseConfirmYourEmail($user));
                break;
            case 'es':
                Mail::to($user)->send(new PorFavorConfirmeSuCorreo($user));
                break;
        }

        return Mail::to('wedcontest@diproinduca.com')->send(new ResendRepresentantRegisteredEmail($user));
    }
}
