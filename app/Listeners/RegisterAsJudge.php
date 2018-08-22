<?php

namespace App\Listeners;

use App\Events\JudgeRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Role;

class RegisterAsJudge
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
     * @param  JudgeRegistered  $event
     * @return void
     */
    public function handle(JudgeRegistered $event)
    {
        $role = Role::whereName('Judge')->first();
        $event->user->roles()->attach($role);
        $event->user->confirm();
    }
}
