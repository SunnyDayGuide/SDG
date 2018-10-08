<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Market;
use App\Category;
use Storage;

class MarketCategoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($marketId)
    {
        $market = Market::find($marketId);
        $categories = Category::all();

        return view('dashboard.markets.createMarketCategory', compact('market', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $marketId 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $marketId)
    {
        $market = Market::find($marketId);
        $categoryId = request('category_id');

        // validate the data
        request()->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'image'
        ]);

        // process an image if there is one
        $category = Category::find($categoryId);

        if($request->hasFile('image')){
            // add new image
            $image = $request->file('image');
            $filename = $market->code.'-'.$category->slug.'-'.time().'.'.$image->guessClientExtension();
            $image = $image->storeAs('images/leads', $filename, 'public');
        } else {
            $image = null;
        }

        $attributes = [
            'title' => request('title'), 
            'body' => request('body'), 
            'meta_title' => request('meta_title'), 
            'meta_description' => request('meta_description'),
            'image' => $image
        ];

        $market->categories()->attach($categoryId, $attributes);

        return redirect()->route('dashboard.markets.edit', $market->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $marketId, $categoryId
     * @return \Illuminate\Http\Response
     */
    public function edit($marketId, $categoryId)
    {
        $market = Market::find($marketId);
        $category = Category::find($categoryId);

        $market_category = $market->categories()->find($categoryId);

        return view('dashboard.markets.editMarketCategory', compact('market', 'category', 'market_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $marketId, $categoryId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $marketId, $categoryId)
    {
        $market = Market::find($marketId);
        $category = Category::find($categoryId);
        $market_category = $market->categories()->find($categoryId);

        // validate the data
        request()->validate([
            'image' => 'image'
        ]);

        // process an image if there is one
        if($request->hasFile('image')){
            // add new image
            $image = $request->file('image');
            $filename = $market->code.'-'.$category->slug.'-'.time().'.'.$image->guessClientExtension();
            $image = $image->storeAs('images/leads', $filename, 'public');

            // save old file name so we can delete the replaced image 
            $oldFileName = $market_category->pivot->image;

            // update database
            $market->categories()->updateExistingPivot($categoryId, [
                'image' => $image,
            ]);

            // delete old image
            Storage::disk('public')->delete($oldFileName);
        }

        $attributes = [
            'title' => request('title'), 
            'body' => request('body'), 
            'meta_title' => request('meta_title'), 
            'meta_description' => request('meta_description'), 
        ];

        $market->categories()->updateExistingPivot($categoryId, $attributes);

        return redirect()->route('dashboard.markets.edit', $market->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($marketId, $categoryId)
    {
        $market = Market::find($marketId);
        $category = Category::find($categoryId);

        // delete associated image file
        $market_category = $market->categories()->find($categoryId);
        $image = $market_category->pivot->image;
        Storage::disk('public')->delete($image);

        // detach
        $market->categories()->detach($categoryId);

        return redirect()->route('dashboard.markets.edit', $market->id);
    }

}
