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

    public function employees()
    {
    	return $this->belongsToMany(User::class, 'user_department')->withTimestamps();
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
