<?php

namespace App;

use App\Place;

class Distributor extends Place
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The relationships to always eager-load.
     *
     * @var array
     */
    protected $with = ['market', 'media'];

    protected $dates = [
       'created_at',
       'updated_at',
       'deleted_at'
   ];

   protected $cascadeDeletes = ['locations'];

    /**
     * Class for View Presenter.
     *
     * @var string
     */
    protected $presenter = 'App\Presenters\AdvertiserPresenter';

}
