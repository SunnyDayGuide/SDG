<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function markets()
    {
    	return $this->hasMany('App\Market');
    }

    /**
     * Get the brand's facebook.
     *
     * @param  string  $value
     * @return void
     */
    public function getFacebookAttribute()
    {
    	if ($this->id == 3) {
			return "https://facebook.com/colonialguide";
		} elseif ($this->id == 2) {
			return "https://facebook.com/whattodoguide";
		} else
	    return "https://facebook.com/sunnydayguide";
    }

     /**
     * Get the brand's instagram.
     *
     * @param  string  $value
     * @return void
     */
    public function getInstagramAttribute()
    {
    	if ($this->id == 3) {
			return "https://instagram.com/sunnydayguide";
		} elseif ($this->id == 2) {
			return "https://instagram.com/whattodo_guide";
		} else
	    return "https://instagram.com/sunnydayguide";
    }

      /**
     * Get the brand's twitter.
     *
     * @param  string  $value
     * @return void
     */
    public function getTwitterAttribute()
    {
    	if ($this->id == 3) {
			return "https://twitter.com/colonialguide";
		} elseif ($this->id == 2) {
			return "https://twitter.com/whattodo_guide";
		} else
	    return "https://twitter.com/sunnydayguide";
    }

}
