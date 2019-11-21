<?php

namespace App\Policies;

use App\Market;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarketPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any markets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the market.
     *
     * @param  \App\User  $user
     * @param  \App\Market  $market
     * @return mixed
     */
    public function view(User $user, $model)
    {
        return true;
    }

    /**
     * Determine whether the user can create markets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('manage markets')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the market.
     *
     * @param  \App\User  $user
     * @param  \App\Market  $market
     * @return mixed
     */
    public function update(User $user, $model)
    {
        if ($user->can('manage markets')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the market.
     *
     * @param  \App\User  $user
     * @param  \App\Market  $market
     * @return mixed
     */
    public function delete(User $user, $model)
    {
        if ($user->can('delete markets')) {
            return true;
        }

        return false;
    }

}
