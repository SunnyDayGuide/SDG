<?php

namespace App\Presenters;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Laracasts\Presenter\Presenter;


class EventPresenter extends Presenter
{
	public function start_time()
	{
		$start_time = Carbon::createFromFormat('H:i:s', $this->entity->start_time);
		return '<time>' . $start_time->format('g:ia') . '</time>';
	}

	public function end_time()
	{
		$end_time = Carbon::createFromFormat('H:i:s', $this->entity->end_time);
		return '<time>' . $end_time->format('g:ia') . '</time>';
	}
}