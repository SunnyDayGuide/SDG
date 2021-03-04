<?php

namespace App\Http\ViewComposers;

use App\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class FooterViewComposer
{
	private $market;

    public function __construct(Market $market)
    {
         $this->market = Market::find($this->getMarket());
    }

    public function compose(View $view) 
    {
        if ($this->market->id == 1) {
            $footerImage = 'storage/images/main/footer-banner-bkgrnd-BR.jpg';
        } elseif ($this->market->id == 10) {
            $footerImage = 'storage/images/main/footer-banner-bkgrnd-SM.jpg';
        } elseif ($this->market->id == 11) {
           $footerImage = 'storage/images/main/footer-banner-bkgrnd-CG.jpg';
        } else
        $footerImage = 'storage/images/main/footer-banner-bkgrnd.jpg';

        $coverImage = $this->market->getFirstMedia('cover');

        $view->with(compact('footerImage', 'coverImage'));
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