<?php

namespace App\Policies;

use App\ArticleType;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticleTypePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any article types.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->can('manage articles')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the article type.
     *
     * @param  \App\User  $user
     * @param  \App\ArticleType  $articleType
     * @return mixed
     */
    public function view(User $user, ArticleType $articleType)
    {
        if ($user->can('manage articles')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create article types.
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
     * Determine whether the user can update the article type.
     *
     * @param  \App\User  $user
     * @param  \App\ArticleType  $articleType
     * @return mixed
     */
    public function update(User $user, ArticleType $articleType)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the article type.
     *
     * @param  \App\User  $user
     * @param  \App\ArticleType  $articleType
     * @return mixed
     */
    public function delete(User $user, ArticleType $articleType)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
        return false;
    }

}
