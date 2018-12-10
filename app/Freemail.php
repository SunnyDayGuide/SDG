<?php

namespace App;

use App\FreemailType;
use App\Market;
use Illuminate\Database\Eloquent\Model;

class Freemail extends Model
{
         /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Attributes to cast.
     */
    protected $casts = [
        'active' => 'boolean'
    ];

     /**
     * A type is assigned to a freemail
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function freemailType()
    {
        return $this->belongsTo(FreemailType::class);
    }

     /**
     * An employee is assigned to a freemail
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

     /**
     * An freemail belongs to a market.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function market()
    {
        return $this->belongsTo(Market::class);
    }


}
