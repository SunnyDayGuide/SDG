<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\CustomTag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = CustomTag::all();

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.tags.create', compact('categories'));
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
            'name' => 'required',
        ]);

        $tag = CustomTag::create(request(['name', 'type']));

        return redirect()->route('admin.tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomTag $tag)
    {
        $categories = Category::all();

        return view('admin.tags.edit', compact('tag', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomTag $tag)
    {
        $tag = CustomTag::findorFail($tag->id);

        request()->validate([
            'name' => 'required',
        ]);

        $tag->name = $request->name;
        $tag->type = $request->type;

        $tag->save();

        return redirect()->route('admin.tags.index');
    }

}
