<?php

namespace App\Listeners;

use App\Events\RegisterRepresentant;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Role;

class RegisterAsRepresentant
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
        
        $role=Role::whereName('Representant')->first();
        $event->user->roles()->attach($role);
    }
}
