<?php

namespace App\Http\ViewComposers;

use App\Category;
use App\Market;
use Illuminate\Http\Request;

class NavigationViewComposer
{
	private $market;

    public function __construct(Market $market)
    {
         $this->market = $market;
    }

    public function compose($view)
    {
    	// $market = Market::find(5);

    	// $navCategories =  $this->market->categories()
     //        ->whereNull('parent_id')
	    // 	->has('advertisers')
     //        ->with('availChildren')
     //        ->withCount('advertisers')
     //        ->get();

     //    $view->with(compact('navCategories'));
    }
}