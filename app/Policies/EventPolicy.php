<?php

namespace App\Policies;

use App\Event;
use App\Policies\Policy;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy extends Policy
{
    /**
     * The Permission key the Policy corresponds to.
     *
     * @var string
     */
    public static $key = 'events';

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
}
