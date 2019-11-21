<?php

namespace App\Policies;

use App\Level;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DisplayLevelPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any display levels.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->can('manage advertisers')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the display level.
     *
     * @param  \App\User  $user
     * @param  \App\Level  $displaylevel
     * @return mixed
     */
    public function view(User $user, Level $displaylevel)
    {
        if ($user->can('manage advertisers')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create display levels.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the display level.
     *
     * @param  \App\User  $user
     * @param  \App\Level  $displaylevel
     * @return mixed
     */
    public function update(User $user, Level $displaylevel)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the display level.
     *
     * @param  \App\User  $user
     * @param  \App\Level  $displaylevel
     * @return mixed
     */
    public function delete(User $user, Level $displaylevel)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
        return false;
    }
}
