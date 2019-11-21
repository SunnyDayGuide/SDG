<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
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
        return $user->can('manage ' . static::$key);
    }
    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function delete(User $user, $model)
    {
        if ($user->can('manage ' . static::$key) ) {
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
        if ($user->can('forceDelete ' . static::$key)) {
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
        if ($user->can('restore ' . static::$key)) {
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
        if ($user->can('manage ' . static::$key)) {
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
        if ($user->can('view ' . static::$key)) {
            return true;
        }
        return false;
    }
    /**
     * @param User $user
     */
    public function viewAny(User $user)
    {
        return $user->can('view ' . static::$key);
    }
}
