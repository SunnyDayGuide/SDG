<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    
    public function markets()
    {
        return $this->hasMany(Market::class);
    }


     /**
     * All Available States in SDG company
     */
    public function availableStates()
    {
        return $this::find([9,12,25,30,38,48,50,55,]);
    }
   
}
