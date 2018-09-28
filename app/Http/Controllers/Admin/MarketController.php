<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Market;
use App\Brand;
use App\Category;
use App\State;
use Session;


class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $markets = Market::all();
        return view('dashboard.markets.index', compact('markets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(State $state)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $states = $state->availableStates();

        return view('dashboard.markets.create', compact('market', 'brands', 'categories', 'states'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        request()->validate([
            'code' => 'required|unique:markets|max:2',
            'name' => 'required',
            'slug' => 'required|unique:markets',
            'state_id' => 'required|exists:states,id',
            'brand_id' => 'required|exists:brands,id'
        ]);

        $market = Market::create([
            'code' => request('code'),
            'name' => request('name'),
            'name_alt' => request('name_alt'),
            'cities' => request('cities'),
            'state_id' => request('state_id'),
            'slug' => request('slug'),
            'brand_id' => request('brand_id')
        ]);

        $categories = request('categories');
        $market->categories()->attach($categories);

        return redirect()->route('dashboard.markets.show', $market->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $market = Market::find($id);
        $categories = $market->categories;

        return view('dashboard.markets.show', compact('market', 'categories'));
    }

    // public function getPrimaryState {

    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, State $state)
    {
        $market = Market::find($id);
        $brands = Brand::all();
        $categories = Category::all();
        $states = $state->availableStates();

        return view('dashboard.markets.edit', compact('market', 'brands', 'categories', 'states'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $market = Market::find($id);

        // validate the data
        request()->validate([
            'code' => [
                'required',
                'max:2',
                Rule::unique('markets')->ignore($market->id),
            ],
            'slug' => [
                'required',
                Rule::unique('markets')->ignore($market->id),
            ],
            'name' => 'required',
            'state_id' => 'required|exists:states,id',
            'brand_id' => 'required|exists:brands,id'
        ]);

        $market->code = $request->code;
        $market->name = $request->name;
        $market->name_alt = $request->name_alt;
        $market->state_id = $request->state_id;
        $market->cities = $request->cities;
        $market->slug = $request->slug;
        $market->brand_id = $request->brand_id;

        $market->save();

        $categories = request('categories');
        $market->categories()->sync($categories);

        // return redirect()->route('dashboard.markets.index');
        return redirect('/dashboard/markets');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $market = Market::find($id);
        $market->categories()->detach();

        $market->delete();

        return redirect('/dashboard/markets');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $marketId, $categoryId
     * @return \Illuminate\Http\Response
     */
    public function editMarketCategory($marketId, $categoryId) {
        $market = Market::find($marketId);
        $category = Category::find($categoryId);

        $market_category = $market->categories->get($marketId, $categoryId)->pivot;

        return view('dashboard.markets.editMarketCategory', compact('market', 'category', 'market_category'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $marketId, $categoryId
     * @return \Illuminate\Http\Response
     */
    public function updateMarketCategory(Request $request, $marketId, $categoryId) {
        $market = Market::find($marketId);
        $categories = Category::all();

        $attributes = [
            'title' => request('title'), 
            'body' => request('body'), 
            'image' => request('image'), 
            'meta_title' => request('meta_title'), 
            'meta_description' => request('meta_description'), 
        ];

        $market->categories()->updateExistingPivot($categoryId, $attributes);

        return view('dashboard.markets.show', compact('market', 'brands', 'categories', 'marketCategory'));
    }

    }
