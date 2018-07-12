<?php

namespace App\Listeners;

use App\Events\RegisterRepresentant;
use App\Events\ResendConfirmationLink;
use App\Mail\PleaseConfirmYourEmail;
use App\Mail\PorFavorConfirmeSuCorreo;
use App\Mail\ResendRepresentantRegisteredEmail;
use Illuminate\Support\Facades\Mail;

class ReSendEmail
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
    public function handle(ResendConfirmationLink $event)
    {
//        dd($event->user);
        $user = $event->user;
        switch ($user->language) {

            case 'es':
                Mail::to($user)->send(new PorFavorConfirmeSuCorreo($user));
                break;
            default:
                Mail::to($user)->send(new PleaseConfirmYourEmail($user));
                break;
        }

        return Mail::to('wedcontest@diproinduca.com')->send(new ResendRepresentantRegisteredEmail($user));
    }
}
