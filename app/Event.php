<?php

namespace App;

use App\Market;
use App\Recurrence;
use App\Traits\Categoriable;
use App\Traits\Marketable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Tags\HasTags;

class Event extends Model implements HasMedia
{
    use SoftDeletes;
    use Categoriable;
    use Marketable;
    use HasTags;
    use HasMediaTrait;


    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Attribute Casting
     * @var array
     */
    protected $casts = [
        'is_recurring'     => 'boolean',
        'featured'        => 'boolean',
        'active' => 'boolean',
        'rrule' => 'array',
        'dtstart' => 'datetime:Y-m-d',
        'until' => 'datetime:Y-m-d',
        // 'rrule->bysetpos' => 'array',
    ];

	protected $dates = [
	    'start_date',
	    'end_date',
	    'created_at',
	    'updated_at',
        'deleted_at',
	];

    /**
     * @param $query
     * @return Builder
     */
    public function scopeRecurring($query)
    {
        return $query->where('is_recurring', true);
    }

    /**
     * Scope a query to only include current events.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurrent($query)
    {
        return $query->where('end_date', '>=', Carbon::now());
    }


    /**
     * Scope a query to only include active events.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * The events that belong an advertiser.
     */
    public function advertisers()
    {
        return $this->belongsToMany(Advertiser::class);
    }

    /**
     * Get the recurrences of an event.
     */
    public function recurrences()
    {
        return $this->hasMany(Recurrence::class);
    }

    // register media collection with conversion
    public function registerMediaCollections()
	{
	    $this
	        ->addMediaCollection('inset')
	        ->singleFile()
	        ->registerMediaConversions(function (Media $media) {
	            $this
	                ->addMediaConversion('card')
	                ->crop(Manipulations::CROP_CENTER, 246, 131)
	                ->withResponsiveImages();
	        });
	}

    public function startsAt(\DateTimeInterface $startsAt)
    {
        $this->start_date = Carbon::parse($startsAt);
        return $this;
    }
    public function endsAt(\DateTimeInterface $endsAt)
    {
        $this->end_date = Carbon::parse($endsAt);
        return $this;
    }

    /**
     * Get the events's date range.
     *
     * @return string
     */
    public function getDateRangeAttribute()
    {
        $start = Carbon::parse($this->start_date)->toFormattedDateString();
        $end = Carbon::parse($this->end_date)->toFormattedDateString();

        if ($this->end_date == $this->start_date) {
            $dates = "{$start}";
        } elseif ($this->end_date === null) {
            $dates = "{$start}";
        } else {
            $dates = "{$start} - {$end}";
        }

        return $dates;
    }

    /**
     * Get rrule dtstart.
     *
     * @return string
     */
    public function getDtstartAttribute()
    {
        return $this->start_date;
    }

    /**
     * Get rrule until.
     *
     * @return string
     */
    public function getUntilAttribute()
    {
        return $this->end_date;
    }

        /**
     * Get the events's date range.
     *
     * @return string
     */
    public function getNavRangeAttribute()
    {
        $start = Carbon::parse($this->start_date)->format('n/j');
        $end = Carbon::parse($this->end_date)->format('n/j');

        if ($this->end_date == $this->start_date) {
            $dates = "{$start}";
        } elseif ($this->end_date === null) {
            $dates = "{$start}";
        } else {
            $dates = "{$start} - {$end}";
        }

        return $dates;
    }



}
