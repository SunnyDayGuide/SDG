<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Market;
use App\MarketCategory;
use Illuminate\Http\Request;
use Storage;

class MarketCategoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @param int $marketId
     */
    public function create($marketId)
    {
        $market = Market::find($marketId);
        $categories = Category::all();

        return view('admin.markets.createMarketCategory', compact('market', 'categories'));
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
        $imagePath = 'images/'.$market->slug.'/leads';

        if($request->hasFile('image')){
            // add new image
            $image = $request->file('image');
            $filename = $market->code.'-'.$category->slug.'-'.time().'.'.$image->guessClientExtension();
            $image = $image->storeAs($imagePath, $filename, 'public');
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

        $marketCategory = MarketCategory::where('category_id', $categoryId)->where('market_id', $marketId)->first();

        // new way with Media Library
        $marketCategory->addMedia(request()->file('image'))->toMediaCollection('slider');

        return redirect()->route('admin.markets.edit', $market->id);
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

        return view('admin.markets.editMarketCategory', compact('market', 'category', 'market_category'));
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
        $imagePath = 'images/'.$market->slug.'/leads';

        request()->validate([
            'image' => 'image'
        ]);

        // process an image if there is one
        if($request->hasFile('image')){
            // add new image
            $image = $request->file('image');
            $filename = $market->code.'-'.$category->slug.'-'.time().'.'.$image->guessClientExtension();
            $image = $image->storeAs($imagePath, $filename, 'public');

            // save old file name so we can delete the replaced image 
            $oldFileName = $market_category->pivot->image;

            // delete old image
            Storage::disk('public')->delete($oldFileName);
        }

        $attributes = [
            'title' => request('title'), 
            'body' => request('body'), 
            'meta_title' => request('meta_title'), 
            'meta_description' => request('meta_description'), 
            'image' => $image
        ];

        $market->categories()->updateExistingPivot($categoryId, $attributes);

        $marketCategory = MarketCategory::where('category_id', $categoryId)->where('market_id', $marketId)->first();

        // new way with Media Library
        $marketCategory->addMedia(request()->file('image'))->toMediaCollection('slider');

        return redirect()->route('admin.markets.edit', $market->id);
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

        return redirect()->route('admin.markets.edit', $market->id);
    }

}
