<?php

namespace App\Policies;

use App\Distributor;
use App\Policies\Policy;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DistributorPolicy extends Policy
{
    /**
     * The Permission key the Policy corresponds to.
     *
     * @var string
     */
    public static $key = 'distributors';

}
