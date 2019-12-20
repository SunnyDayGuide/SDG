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
            $instance->dtstart = new \DateTime( $instance->event->start_date.' '.$instance->event->start_time );
            $instance->until = new \DateTime( $instance->event->end_date.' '.$instance->event->end_time );
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
