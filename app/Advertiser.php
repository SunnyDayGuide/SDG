<?php

namespace App;

use App\Article;
use App\Category;
use App\CustomTag;
use App\Event;
use App\Hour;
use App\Menu;
use App\Place;
use App\Show;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\OpeningHours\OpeningHours;
use Spatie\Tags\HasTags;

class Advertiser extends Place
{
    use HasTags;

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

    /**
     * Attributes to cast.
     */
    protected $casts = [
        'hours' => 'array',
    ];

    protected $cascadeDeletes = ['locations'];


    /**
     * Class for View Presenter.
     *
     * @var string
     */
    protected $presenter = 'App\Presenters\AdvertiserPresenter';

    /**
     * The hours that belong to the advertiser.
     */
    public function openingHours()
    {
        return $this->hasMany(Hour::class);
    }

    /**
     * The coupons that belong to the advertiser.
     */
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class);
    }

    /**
     * The ads in which this advertiser appears.
     */
    public function ads()
    {
        return $this->belongsToMany(Ad::class, 'advertiser_pdf', 'advertiser_id', 'pdf_id')
        ->where('type', 'ad')->withTimestamps();
    }

    /**
     * The menus in which this advertiser appears.
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'advertiser_pdf', 'advertiser_id', 'pdf_id')
        ->where('type', 'menu')->withTimestamps();
    }

    /**
     * The articles that belong an advertiser.
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    /**
     * The events that belong an advertiser.
     */
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    /**
     * The shows that belong an advertiser.
     */
    public function shows()
    {
        return $this->hasMany(Show::class);
    }



    public static function getTagClassName(): string
    {
        return CustomTag::class;
    }

    public function tags(): MorphToMany
    {
        return $this
        ->morphToMany(self::getTagClassName(), 'taggable', 'taggables', null, 'tag_id')
        ->orderBy('order_column');
    }

     /**
     * Determine if an advertiser is a restaurant
     *
     * @return boolean
     */
     public function isRestaurant()
     {
        // get dining subcat ids
        $categoryIds = Category::where('parent_id', 2)->pluck('id');

        // add dining cat id to the array
        $categoryIds[] = 2; 

        $restaurant = $this->categories->whereIn('parent_id', $categoryIds);

        if ($restaurant->isNotEmpty()) {
            return true;
        } else return false;
    }

    /**
     * Determine if an advertiser is an accommodation
     *
     * @return boolean
     */
    public function isAccommodation()
    {
        // get accommodations subcat ids
        $categoryIds = Category::where('parent_id', 5)->pluck('id');

        // add accommodations cat id to the array
        $categoryIds[] = 5; 

        $accommodation = $this->categories->whereIn('parent_id', $categoryIds);

        if ($accommodation->isNotEmpty()) {
            return true;
        } else return false;
    }

    /**
     * fill advertiser hours into Spatie\OpeningHours\OpeningHours
     */
    public function fillHours()
    {
        $hours = $this->createHoursArray();
        // Come back and do exceptions
        // $exceptions = $this->exceptions;
        
        $opening_hours = OpeningHours::createAndMergeOverlappingRanges(array_merge($hours,['overflow' => true]));

        return $opening_hours;
    }

    public function createHoursArray()
    {
        $openingHours = $this->openingHours;
        $grouped = $openingHours->groupBy('day');
        $days = $grouped->toArray();

        $hours_array = [];

        foreach ($days as $day => $hours) {
            $i = count($hours);

            $range = [];

            while($i > 0) {
                $range[] = $hours[$i-1]['range'];
                $i--;
            }

            $hours_array[$day] = $range;
        } 
        unset($day);

        return $hours_array;
    }

}
