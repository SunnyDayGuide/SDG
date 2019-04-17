<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected static function boot()
	{
	    parent::boot();

	    static::creating(function ($query) {
	        $query->type = 'menu';
	    });

	    static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'menu');
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
