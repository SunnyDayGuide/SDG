<?php

namespace App\Policies;

use App\Logo;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LogoPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any logos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->can('manage logos')) {
            return true;
        }

        if ($user->can('manage advertisers')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the logo.
     *
     * @param  \App\User  $user
     * @param  \App\Logo  $logo
     * @return mixed
     */
    public function view(User $user, Logo $logo)
    {
        if ($user->can('manage logos')) {
            return true;
        }

        if ($user->can('manage advertisers')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create logos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('manage advertisers')) {
            return true;
        }

        if ($user->can('manage logos')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the logo.
     *
     * @param  \App\User  $user
     * @param  \App\Logo  $logo
     * @return mixed
     */
    public function update(User $user, Logo $logo)
    {
        if ($user->can('manage advertisers')) {
            return true;
        }

        if ($user->can('manage logos')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the logo.
     *
     * @param  \App\User  $user
     * @param  \App\Logo  $logo
     * @return mixed
     */
    public function delete(User $user, Logo $logo)
    {
        if ($user->can('manage advertisers')) {
            return true;
        }

        if ($user->can('manage logos')) {
            return true;
        }
    }

}
