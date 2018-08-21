<?php

namespace App\Listeners;

use App\Events\RegisterRepresentant;
use App\Mail\PleaseConfirmYourEmail;
use App\Mail\PorFavorConfirmeSuCorreo;
use App\Mail\JudgeRegistered;
use Illuminate\Support\Facades\Mail;
use App\Events\JudgeRegistered as JudgeEvent;


class SendJudgesEmail
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
    public function handle(JudgeEvent $event)
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

        return Mail::to('wedcontest@diproinduca.com')->send(new JudgeRegistered($user));
    }
}
