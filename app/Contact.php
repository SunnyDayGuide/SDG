<?php

namespace App;

use App\Market;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    const ADVERTISING_TYPE = 'Advertising';
    const DISTRIBUTION_TYPE = 'Distribution';
    const OTHER_TYPE = 'Other';

     /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $fillable = [
        'market_id',
        'first_name',
        'last_name',
        'email',
        'contact_type',
        'comment',
        'cookie_consent',
        'sdg_consent'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($lead) {
            $lead->full_name = $lead->first_name . ' ' . $lead->last_name;
        });
    }

    protected $dates = [
	    'created_at',
	    'updated_at',
	];

	 /**
     * Attributes to cast.
     */
    protected $casts = [
        'cookie_consent' => 'boolean',
        'sdg_consent' => 'boolean',
    ];

    /**
     * A Contact belongs to a market.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    public static function getTypes()
    {
        return [
            self::ADVERTISING_TYPE => self::ADVERTISING_TYPE,
            self::DISTRIBUTION_TYPE => self::DISTRIBUTION_TYPE,
            self::OTHER_TYPE => self::OTHER_TYPE,
        ];
    }
}
