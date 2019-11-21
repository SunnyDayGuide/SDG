<?php

namespace App\Policies;

use App\Location;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any locations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->can('manage advertisers')) {
            return true;
        }

        if ($user->can('view advertisers')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the location.
     *
     * @param  \App\User  $user
     * @param  \App\Location  $location
     * @return mixed
     */
    public function view(User $user, Location $location)
    {
        if ($user->can('manage advertisers')) {
            return true;
        }

        if ($user->can('view advertisers')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create locations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('manage advertisers')) {
            return true;
        }

        if ($user->can('edit advertisers')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the location.
     *
     * @param  \App\User  $user
     * @param  \App\Location  $location
     * @return mixed
     */
    public function update(User $user, Location $location)
    {
        if ($user->can('manage advertisers')) {
            return true;
        }

        if ($user->can('edit advertisers')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the location.
     *
     * @param  \App\User  $user
     * @param  \App\Location  $location
     * @return mixed
     */
    public function delete(User $user, Location $location)
    {
        if ($user->can('manage advertisers')) {
            return true;
        }

        if ($user->can('edit advertisers')) {
            return true;
        }
    }

}
