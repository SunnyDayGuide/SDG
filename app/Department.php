<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The employees that belong to the department.
     */
    public function employees()
    {
    	return $this->belongsToMany(User::class, 'user_department')->withTimestamps();
    }

    /**
     * Get the manager that runs the department.
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
