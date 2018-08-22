<?php

namespace App\Providers;

use App\Listeners\RegisterAsRepresentant;
use App\Listeners\RegisterAsJudge;
use App\Listeners\ReSendEmail;
use App\Listeners\SendEmail;
use App\Listeners\SendJudgesEmail;
use App\Listeners\SubscribeToNewsletter;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\RegisterRepresentant' => [
            RegisterAsRepresentant::class,
            SendEmail::class,
            SubscribeToNewsletter::class,
        ],
        'App\Events\JudgeRegistered' => [
            RegisterAsJudge::class,
            //SendJudgesEmail::class,
        ],
        'App\Events\RegisterContestant' => [
            'App\Listeners\RegisterAsContestant',
            'App\Listeners\SubscribeToContestantNewsletter',
        ],
        'App\Events\ResendConfirmationLink' => [
            ReSendEmail::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
