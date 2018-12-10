<?php

namespace App\Http\Controllers\Admin;

use App\Freemail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FreemailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $freemails = Freemail::paginate(10);

        return view('admin.freemails.index', compact('freemails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Freemail  $freemail
     * @return \Illuminate\Http\Response
     */
    public function show(Freemail $freemail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Freemail  $freemail
     * @return \Illuminate\Http\Response
     */
    public function edit(Freemail $freemail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Freemail  $freemail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Freemail $freemail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Freemail  $freemail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Freemail $freemail)
    {
        //
    }
}
