<?php

namespace App\Presenters;

use Illuminate\Support\Str;
use Laracasts\Presenter\Presenter;


class LocationPresenter extends Presenter
{
	public function card()
	{
		if ($this->entity->alt_address) {
			$address = $this->entity->alt_address . "<br>" . $this->entity->city . ", " . $this->entity->state . ' ' .$this->entity->postal_code;
		} else $address = $this->entity->street_number . ' ' . $this->entity->route . "<br>" . $this->entity->city . ", " . $this->entity->state . ' ' . $this->entity->postal_code;

		 return $address;
	}
}