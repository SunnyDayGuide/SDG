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
use Storage;


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

        return view('admin.markets.index', compact('markets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @param  State $state
     */
    public function create(State $state)
    {
        $brands = Brand::all();
        $states = $state->availableStates();

        return view('admin.markets.create', compact('market', 'brands', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'code' => 'required|unique:markets|max:2',
            'name' => 'required',
            'slug' => 'required|unique:markets',
            'state_id' => 'required|exists:states,id',
            'brand_id' => 'required|exists:brands,id'
        ]);

        $market = Market::create(request([
            'code', 'name', 'name_alt', 'cities', 'state_id', 'slug', 'brand_id'
        ]));

        return redirect()->route('admin.markets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * Don't likely need anymore, but hang onto in the meantime
     */
    public function show($id)
    {
        $market = Market::find($id);
        $categories = $market->categories;

        return view('admin.markets.show', compact('market', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  State $state
     * @return \Illuminate\Http\Response
     */
    public function edit($id, State $state)
    {
        $market = Market::find($id);
        $brands = Brand::all();
        $categories = $market->categories;
        $states = $state->availableStates();

        return view('admin.markets.edit', compact('market', 'brands', 'categories', 'states'));
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

        $market->update(request([
            'code', 'name', 'name_alt', 'cities', 'state_id', 'slug', 'brand_id'
        ]));

        return redirect()->route('admin.markets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Category $category)
    {
        $market = Market::find($id);
        $market->deleteCategoryImages($id);
        $market->categories()->detach();
        $market->delete();

        return redirect()->route('admin.markets.index');
    }
}