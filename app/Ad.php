<?php

namespace App;

use App\Advertiser;
use App\Market;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
	protected static function boot()
	{
	    parent::boot();

	    static::creating(function ($query) {
	        $query->type = 'ad';
	    });

	    static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'ad');
        });
	}

	protected $table = 'pdfs';

    /**
     * A pdf belongs to a market.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function market()
    {
    	return $this->belongsTo(Market::class);
    }

     /**
     * Get the advertisers that appear in this pdf.
     */
    public function advertisers()
    {
        return $this->belongsToMany(Advertiser::class, 'advertiser_pdf', 'pdf_id', 'advertiser_id')->withTimestamps();
    }


}
