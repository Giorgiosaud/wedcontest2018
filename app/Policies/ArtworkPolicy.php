<?php

namespace App\Policies;

use App\Contestant;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArtworkPolicy
{
    use HandlesAuthorization;
     /**
     * Determine if the authenticated user has permission to update a reply.
     *
     * @param  User  $user
     * @param  Reply $reply
     * @return bool
     */
     public function update(User $user, Contestant $reply)
     {
        return $reply->user_id == $user->id;
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
