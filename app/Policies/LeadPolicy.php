<?php

namespace App\Policies;

use App\Lead;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any leads.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->can('view leads')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the lead.
     *
     * @param  \App\User  $user
     * @param  \App\Lead  $lead
     * @return mixed
     */
    public function view(User $user, Lead $lead)
    {
        if ($user->can('view leads')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create leads.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('manage leads')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the lead.
     *
     * @param  \App\User  $user
     * @param  \App\Lead  $lead
     * @return mixed
     */
    public function update(User $user, Lead $lead)
    {
        if ($user->can('manage leads')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the lead.
     *
     * @param  \App\User  $user
     * @param  \App\Lead  $lead
     * @return mixed
     */
    public function delete(User $user, Lead $lead)
    {
        if ($user->can('manage leads')) {
            return true;
        }
    }

}
