<?php

namespace App\Policies;

use App\User;
use App\Claim;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClaimPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the claim.
     *
     * @param  \App\User  $user
     * @param  \App\Claim  $claim
     * @return mixed
     */
    public function view(User $user, Claim $claim)
    {
        //
    }

    /**
     * Determine whether the user can create claims.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->canCreateClaim();
    }

    /**
     * Determine whether the user can update the claim.
     *
     * @param  \App\User  $user
     * @param  \App\Claim  $claim
     * @return mixed
     */
    public function update(User $user, Claim $claim)
    {
        return $user->id==$claim->user_id;
    }

    /**
     * Determine whether the user can delete the claim.
     *
     * @param  \App\User  $user
     * @param  \App\Claim  $claim
     * @return mixed
     */
    public function delete(User $user, Claim $claim)
    {
        return $user->id==$claim->user_id;
    }
}
