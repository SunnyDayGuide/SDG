<?php

namespace App;

use App\Market;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Lead extends Model
{
	const GUIDE_DOWNLOAD_TYPE = 'Guide Download';
    const INFORMATION_REQUEST_TYPE = 'Information Request';

     /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    protected $dates = [
	    'created_at',
	    'updated_at',
        'visit_date',
	];

	 /**
     * Attributes to cast.
     */
    protected $casts = [
        'cookie_consent' => 'boolean',
        'freemail_consent' => 'boolean',
        'sdg_consent' => 'boolean',
        'interests' => 'array'
    ];

     /**
     * A Lead belongs to a market.
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
            self::GUIDE_DOWNLOAD_TYPE => self::GUIDE_DOWNLOAD_TYPE,
            self::INFORMATION_REQUEST_TYPE => self::INFORMATION_REQUEST_TYPE,
        ];
    }

     /**
     * Mutator to save proper date format to MySQL
     */
    // From https://laraveldaily.com/how-to-change-date-format-in-laravel-and-jquery-ui-datepicker/
    public function setVisitDateAttribute($input)
    {
        $this->attributes['visit_date'] = empty($input) ? null : 
          Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
    }


}
