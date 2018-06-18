<?php

namespace App\Policies;

use App\Contestant;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContestantPolicy
{
    use HandlesAuthorization;
    public function createArtwork(User $user,Contestant $contestant){
        if($user->isAdmin){
            return true;
        }
        return $contestant->representant->id===$user->id;
    }
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
