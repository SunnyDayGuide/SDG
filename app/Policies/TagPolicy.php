<?php

namespace App\Policies;

use App\CustomTag;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any custom tags.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->can('manage tags')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the custom tag.
     *
     * @param  \App\User  $user
     * @param  \App\CustomTag  $customTag
     * @return mixed
     */
    public function view(User $user, CustomTag $customTag)
    {
        if ($user->can('manage tags')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create custom tags.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('manage tags')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the custom tag.
     *
     * @param  \App\User  $user
     * @param  \App\CustomTag  $customTag
     * @return mixed
     */
    public function update(User $user, CustomTag $customTag)
    {
        if ($user->can('manage tags')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the custom tag.
     *
     * @param  \App\User  $user
     * @param  \App\CustomTag  $customTag
     * @return mixed
     */
    public function delete(User $user, CustomTag $customTag)
    {
        if ($user->can('manage tags')) {
            return true;
        }
    }

}
