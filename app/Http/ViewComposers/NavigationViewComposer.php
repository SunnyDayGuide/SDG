<?php

namespace App\Http\ViewComposers;

use App\Category;
use App\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class NavigationViewComposer
{
	private $market;

    public function __construct(Market $market)
    {
         $this->market = Market::find($this->getMarket());
    }

    public function compose(View $view) 
    {
    	$navCategories =  $this->market->navCategories;

        $navArticles =  $this->market->getFeaturedArticles()->where('article_type_id', 1)->take(4)->get();
        
        $featuredArticle = $navArticles->first();

        $navEvents =  $this->market->events()->current()->active()
            ->orderBy('start_date', 'asc')
            ->take(4)->get();

        $view->with(compact('navCategories', 'navArticles', 'featuredArticle', 'navEvents'));
    }

    // find the current market
    public function getMarket()
    {
        $currentRoute = Route::current();
        $params = $currentRoute->parameters;

        $market = $params['market']['id'];

        return $market;
    }
}