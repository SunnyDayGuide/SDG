<?php

namespace App\Presenters;

use Illuminate\Support\Str;
use Laracasts\Presenter\Presenter;

class AdvertiserPresenter extends Presenter
{
	public function blurb()
    {
        return Str::words($this->entity->write_up, 10, '...');
    }

    public function blurb_long()
    {
        return Str::limit($this->entity->write_up, 170, '...');
    }

    public function meals()
    {
        return $this->groupAttributes('dining-meals');
    }

    public function reservations()
    {
        return $this->groupAttributes('dining-reservations');
    }

    public function dining_amenities()
    {
        return $this->amenities('dining-other', 'App\Advertiser');
    }

    /**
     * Present a list of a group's restaurant amenities.
     *
     * @param  string  $group
     * @return string
     */
    public function groupAttributes($group)
    {
        $attributes = app('rinvex.attributes.attribute')::where('group', $group)->whereHas('entities', function ($query) {
            $query->where('entity_type', '=', 'App\Advertiser');
        })->get();

        if (!$attributes) {
            return [];
        }

        $values = [];

        foreach ($attributes as $attribute) {
            if ($this->entity->has($attribute->slug) && $this->entity->{$attribute->slug} == true) {
               $values[$attribute->slug] = $attribute->name;
            }
        }

        return implode( ", ", $values );
    }

    /**
     * Present a list of a group's amenities.
     *
     * @return array
     */
    public function amenities($group, $entityType)
    {
    	$attributes = app('rinvex.attributes.attribute')::where('group', $group)->whereHas('entities', function ($query) use ($entityType) {
            $query->where('entity_type', '=', $entityType);
        })->get()->sortBy('sort_order');

        if (!$attributes) {
            return [];
        }

        $values = [];

        foreach ($attributes as $attribute) {
            // if type is boolean assign $value to either 'yes' or 'no'
        	if($attribute->type == 'boolean') {
        		if ($this->entity->{$attribute->slug} == true) {
        			$value = 'Yes';
        		} else $value = 'No';
            } 
            // if type is integer assign $value to the 'normalized' text string for the integer's value
            elseif($attribute->type == 'integer') {
                if ($this->entity->{$attribute->slug}) {
                    $value = \App\Normal::where('id', $this->entity->{$attribute->slug})
                    ->firstorFail()
                    ->normalized;
                } else $value = '---';
            } 
            // otherwise, just  assign $value to the content of the amenity
            else $value = $this->entity->{$attribute->slug};

            // now format
            $values[] = '<span class="amenity">'. $attribute->name . '</span>'. $value;
        }

        // return an array to iterate over
        return $values;
    }

}