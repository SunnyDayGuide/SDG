<?php

namespace App\Policies;

use App\Advertiser;
use App\Category;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvertiserPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any advertisers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->can('view advertisers')) {
            return true;
        }

        if ($user->can('manage articles')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the advertiser.
     *
     * @param  \App\User  $user
     * @param  \App\Advertiser  $advertiser
     * @return mixed
     */
    public function view(User $user, Advertiser $advertiser)
    {
        if ($user->can('view advertisers')) {
            return true;
        }

        if ($user->can('manage articles')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create advertisers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('manage advertisers')) {
            return true;
        }

        if ($user->can('create advertisers')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the advertiser.
     *
     * @param  \App\User  $user
     * @param  \App\Advertiser  $advertiser
     * @return mixed
     */
    public function update(User $user, Advertiser $advertiser)
    {
        if ($user->can('manage advertisers')) {
            return true;
        }

        if ($user->can('edit advertisers')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the advertiser.
     *
     * @param  \App\User  $user
     * @param  \App\Advertiser  $advertiser
     * @return mixed
     */
    public function delete(User $user, Advertiser $advertiser)
    {
        if ($user->can('manage advertisers')) {
            return true;
        }

        if ($user->can('delete advertisers')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the advertiser.
     *
     * @param  \App\User  $user
     * @param  \App\Advertiser  $advertiser
     * @return mixed
     */
    public function restore(User $user, Advertiser $advertiser)
    {
        if ($user->can('restore advertisers')) {
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the advertiser.
     *
     * @param  \App\User  $user
     * @param  \App\Advertiser  $advertiser
     * @return mixed
     */
    public function forceDelete(User $user, Advertiser $advertiser)
    {
        if ($user->can('forceDelete advertisers')) {
            return true;
        }
    }

    public function attachArticle(User $user, Advertiser $advertiser, Article $article)
    {
        return true;
    }

    public function detachArticle(User $user, Advertiser $advertiser, Article $article)
    {
        if ($user->can('manage articles')) {
            return true;
        }
    }

    public function attachCategory(User $user, Advertiser $advertiser, Category $category)
    {
        if ($user->can('manage advertisers')) {
            return true;
        }
    }

    public function detachCategory(User $user, Advertiser $advertiser, Category $category)
    {
        if ($user->can('manage advertisers')) {
            return true;
        }
    }

    public function attachAnyCategory(User $user, Advertiser $advertiser)
    {
        if ($user->can('manage advertisers')) {
            return true;
        }
    }

    public function attachAnyAd(User $user, Advertiser $advertiser)
    {
        if ($user->can('manage advertisers')) {
            return true;
        }
    }
}
