<?php

namespace App;

use App\Advertiser;
use App\Article;
use App\Coupon;
use App\Event;
use App\MarketCategory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Category extends Model
{
    use Sluggable;

    public static function boot()
    {
        parent::boot();

        // for Scout searches
        static::saved(function ($model) {
            $model->articles->filter(function ($item) {
                return $item->shouldBeSearchable();
            })->searchable();
        });
    }

	/**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the route key name for Laravel.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get a string path for the category.
     *
     * @return string
     */
    public function path()
    {
        if ($this->parent()->exists()) {
            return $this->market->path() . "/{$this->parent->slug}" . "/{$this->slug}";
        } else
        return $this->market->path() . "/{$this->slug}";
    }

    /**
     * Get all of the owning categoriable models.
     */
    public function categoriable()
    {
        return $this->morphTo();
    }

    /**
     * The markets that belong to the category.
     */
   public function markets() 
   {
        return $this->belongsToMany(Market::class, 'market_category')
        ->using(MarketCategory::class)
        ->withTimestamps();
    }

    /**
     * Get the parent category that owns this category.
     */
    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the children of the category (most often its subcategories).
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Scope a query to only include parent categories.
     *
     * @param $market
     * @return \Illuminate\Database\Eloquent\Builder
     */
     public function scopeIsParent($query)
     {
        return $query->whereNull('parent_id');
    }

    /**
     * Get all of the articles that are assigned this category.
     */
    public function articles()
    {
    	return $this->morphedByMany(Article::class, 'categoriable');
    }

    /**
     * Get all of the advertisers that are assigned this category.
     */
    public function advertisers()
    {
        return $this->morphedByMany(Advertiser::class, 'categoriable');
    }

    /**
     * Get all of the coupons for the category.
     */
    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    /**
     * Get all of the events that are assigned this category.
     */
    public function events()
    {
        return $this->morphedByMany(Event::class, 'categoriable');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * The slug is generated for a subcategory from it's name, but the slug is scoped to the parent category. 
     * So Shopping can have a subcategory with the same name as Activities, but both subcats will have the same slug.
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $attribute
     * @param array $config
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithUniqueSlugConstraints(Builder $query, Model $model, $attribute, $config, $slug)
    {
        $category = $model->parent;
        return $query->where('parent_id', $category->getKey());
    }

    // determines what subcategories show up in the top navigation
    public function navSubcategories()
    {
        // grab route parameters to determine what market we are in.
        $currentRoute = Route::current();
        $params = $currentRoute->parameters;

        $market = $params['market']['id'];

        // only take subcategories that HAVE advertisers, then sort by how many advertisers a subcat has
        $subcategories = $this->children()->whereHas('advertisers', function (Builder $query) use ($market) {
                $query->where('market_id', $market);
            })
            ->withCount(['advertisers' => function ($query) use ($market) {
                 $query->where('market_id', $market);
            }])
            ->orderBy('advertisers_count', 'desc');

            return $subcategories;
    }

    // determines what subcategories show up in the article search pulldown
    public function searchSubcategories()
    {
        // grab route parameters to determine what market we are in.
        $currentRoute = Route::current();
        $params = $currentRoute->parameters;

        $market = $params['market']['id'];

        // only take subcategories that HAVE articles, then sort by how many articles a subcat has
        $subcategories = $this->children()->whereHas('articles', function (Builder $query) use ($market) {
                $query->where('market_id', $market);
            })
            ->withCount(['articles' => function ($query) use ($market) {
                 $query->where('market_id', $market);
            }])
            ->orderBy('articles_count', 'desc');

            return $subcategories;
    }

    /**
     * Returns a collection of Articles related to a Category (or subcategory).
     * 
     * @param Category $category
     * @param Category $subcategory = null
     * @param integer $quantity
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRelatedArticles($category, $subcategory = null, $quantity)
    {
        $articles = Article::inRandomOrder()->get();
        $catArticles = Article::categorized($category)->inRandomOrder()->get();
        $subcatArticles = Article::categorized($subcategory)->inRandomOrder()->get();

        if ( is_null($subcategory)  ) {
            $mergedArticles = $catArticles->merge($articles);
        } else $mergedArticles = $subcatArticles->merge($catArticles)->merge($articles);

        // return the first 3
        return $relatedArticles = $mergedArticles->take($quantity);
    }
    
}
