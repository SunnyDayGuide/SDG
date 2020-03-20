<?php

namespace App\Policies;

use App\Map;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MapPolicy
{
    use HandlesAuthorization;

        /**
     * Determine whether the user can view any Maps.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the Map.
     *
     * @param  \App\User  $user
     * @param  \App\Map  $map
     * @return mixed
     */
    public function view(User $user, Map $map)
    {
        //
    }

    /**
     * Determine whether the user can create Maps.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the Map.
     *
     * @param  \App\User  $user
     * @param  \App\Map  $map
     * @return mixed
     */
    public function update(User $user, Map $map)
    {
        //
    }

    /**
     * Determine whether the user can delete the Map.
     *
     * @param  \App\User  $user
     * @param  \App\Map  $map
     * @return mixed
     */
    public function delete(User $user, Map $map)
    {
        //
    }

    /**
     * Determine whether the user can restore the Map.
     *
     * @param  \App\User  $user
     * @param  \App\Map  $map
     * @return mixed
     */
    public function restore(User $user, Map $map)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the Map.
     *
     * @param  \App\User  $user
     * @param  \App\Map  $map
     * @return mixed
     */
    public function forceDelete(User $user, Map $map)
    {
        //
    }
}
