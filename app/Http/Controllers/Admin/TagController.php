<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Controllers\Controller;
use Conner\Tagging\Model\Tag;
use Conner\Tagging\Model\TagGroup;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::with('group')->get();

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tagGroups = TagGroup::all();

        return view('admin.tags.create', compact('tagGroups'));
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

        $tag = Tag::create(request(['name']));

        if (isset($request->tag_group)) {
            $tag->setGroup($request->tag_group);
        }

        return redirect()->route('admin.tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        $tagGroups = TagGroup::all();

        return view('admin.tags.edit', compact('tag', 'tagGroups'));
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
        $tag = Tag::findorFail($id);

        request()->validate([
            'name' => 'required',
        ]);

        $tag->update(request(['name']));

         if (isset($request->tag_group)) {
            $tag->setGroup($request->tag_group);
        } else $tag->removeGroup($tag->group->name);

        return redirect()->route('admin.tags.index');
    }

}
