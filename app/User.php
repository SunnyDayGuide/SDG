<?php

namespace App;

use App\Department;
use App\Events\UserCreated;
use App\Market;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dispatchesEvents = [
        'created' => UserCreated::class
    ];

    /**
     * The departments that belong to the user.
     */
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'user_department')->withTimestamps();
    }

    /**
     * The markets that belong to the user.
     */
    public function markets()
    {
        return $this->belongsToMany(Market::class, 'user_market')->withTimestamps();
    }

    /**
     * The departments that a user manages.
     */
    public function manages()
    {
        return $this->hasMany(Department::class);
    }

}
