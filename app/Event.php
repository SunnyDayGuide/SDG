<?php

namespace App;

use App\Market;
use App\Traits\Categoriable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Tags\HasTags;

class Event extends Model implements HasMedia
{
    use SoftDeletes;
    use Categoriable;
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
        'frequency_options' => 'object',
    ];

	protected $dates = [
	    'start_date',
	    'end_date',
	    'end_of_recurring',
	    'created_at',
	    'updated_at',
        'deleted_at'
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
     * An article belongs to a market.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function market()
    {
    	return $this->belongsTo(Market::class);
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




}
