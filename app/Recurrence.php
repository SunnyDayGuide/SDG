<?php

namespace App;

use App\Event;
use Illuminate\Database\Eloquent\Model;

class Recurrence extends Model
{
    public static function boot()
    {
        parent::boot();
        
        static::saving(function ($instance) {
            $instance->dtstart = $instance->event->start_date;
            $instance->until = $instance->event->end_date;
        });
    }

  /**
   * All of the relationships to be touched. 
   *
   * @var array
   */
  protected $touches = ['event'];

	protected $dates = [
	    'created_at',
	    'updated_at',
        'dtstart',
        'until',
	];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
