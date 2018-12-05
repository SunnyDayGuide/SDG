<?php

namespace App\Http\Controllers\Admin;

use App\FreemailType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FreemailTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $freemailTypes = FreemailType::all();

        return view('admin.freemail.types-index', compact('freemailTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.freemail.types-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(['name' => 'required|unique:freemail_types']);

        $type = FreemailType::create(request(['name']));

        return redirect()->route('admin.freemail-types.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FreemailType  $freemailType
     * @return \Illuminate\Http\Response
     */
    public function edit(FreemailType $freemailType)
    {
        return view('admin.freemail.types-edit', compact('freemailType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FreemailType  $freemailType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FreemailType $freemailType)
    {
        request()->validate(['name' => Rule::unique('freemail_types')->ignore($freemailType->id),]);

        $freemailType->update(request(['name']));

        return redirect()->route('admin.freemail-types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FreemailType  $freemailType
     * @return \Illuminate\Http\Response
     */
    public function destroy(FreemailType $freemailType)
    {
        $freemailType->delete();

        return redirect()->route('admin.freemail-types.index');
    }
}
