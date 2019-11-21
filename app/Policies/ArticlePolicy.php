<?php

namespace App\Policies;

use App\Advertiser;
use App\Article;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any articles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->can('view articles')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the article.
     *
     * @param  \App\User  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function view(User $user, Article $article)
    {
        if ($user->can('manage articles')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create articles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('manage articles')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the article.
     *
     * @param  \App\User  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function update(User $user, Article $article)
    {
        if ($user->can('manage articles')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the article.
     *
     * @param  \App\User  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function delete(User $user, Article $article)
    {
        if ($user->can('manage articles')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the article.
     *
     * @param  \App\User  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function restore(User $user, Article $article)
    {
        if ($user->can('manage articles')) {
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the article.
     *
     * @param  \App\User  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function forceDelete(User $user, Article $article)
    {
        if ($user->can('manage articles')) {
            return true;
        }
    }

    public function addArticleType(User $user, Article $article)
    {
        return true;
    }

    public function attachAnyCategory(User $user, Article $article)
    {
        if ($user->can('manage articles')) {
            return true;
        }
    }

    public function detachCategory(User $user, Article $article)
    {
        if ($user->can('manage articles')) {
            return true;
        }
    }

    public function attachAdvertiser(User $user, Article $article, Advertiser $advertiser)
    {
        if ($user->can('manage articles')) {
            return true;
        }
    }

    public function detachAdvertiser(User $user, Article $article, Advertiser $advertiser)
    {
        if ($user->can('manage articles')) {
            return true;
        }
    }
}
