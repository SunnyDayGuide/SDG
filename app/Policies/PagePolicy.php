<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }
    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('manage pages');
    }
    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function delete(User $user, $model)
    {
        if ($user->can('manage pages') ) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function update(User $user, $model)
    {
        if ($user->can('manage pages')) {
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function view(User $user, $model)
    {
        if ($user->can('manage pages')) {
            return true;
        }
        return false;
    }
    /**
     * @param User $user
     */
    public function viewAny(User $user)
    {
        return $user->can('manage pages');
    }
}
