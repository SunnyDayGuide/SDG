<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FreemailPolicy
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
        return $user->can('manage freemails');
    }
    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function delete(User $user, $model)
    {
        if ($user->can('manage freemails') ) {
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function forceDelete(User $user, $model)
    {
        if ($user->can('forceDelete freemails')) {
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function restore(User $user, $model)
    {
        if ($user->can('restore freemails')) {
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
        if ($user->can('manage freemails')) {
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
        if ($user->can('view freemails')) {
            return true;
        }
        return false;
    }
    /**
     * @param User $user
     */
    public function viewAny(User $user)
    {
        return $user->can('view freemails');
    }
}
