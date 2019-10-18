<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\OpeningHours\OpeningHours;

class Hour extends Model
{
    public function fillHours()
    {
        $openingHours = (new OpeningHours)->fill([
            'monday' => [
                $this->monday->hours
            ],
            'tuesday' => [
                $this->tuesday->hours
            ],
            'wednesday' => [
                $this->wednesday->hours
            ],
            'thursday' => [
                $this->thursday->hours
            ],
            'friday' => [
                $this->friday->hours
            ],
            'saturday' => [
                $this->saturday->hours
            ],
            'sunday' => [
                $this->sunday->hours
            ],
        ]);

        return $openingHours;
        
    }
    public function getHours()
    {
        $hours = $this->fillHours();
        return $openingHours = $hours->forWeek();
    }


}
