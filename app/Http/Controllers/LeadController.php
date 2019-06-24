<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLead;
use App\Lead;
use App\Market;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public $group;

    public function __construct()
    {
        $path = Request::capture()->path();
        $group = strtolower(explode("/", $path)[2]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Market $market)
    {
        $path = Request::capture()->path();
        $group = strtolower(explode("/", $path)[2]);

        return view($group.'.create', compact('market', 'group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Market $market)
    {
        if (request('request_type') == 'guide-request') {
            $type = Lead::GUIDE_DOWNLOAD_TYPE;
        } else 
        $type = Lead::INFORMATION_REQUEST_TYPE;

        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'postal_code' => 'max:25',
            'visit_date' => 'nullable|date',
            'cookie_consent' => 'required|boolean',
            'freemail_consent' => 'required|boolean',
            'sdg_consent' => 'required|boolean',
        ]);

        $lead = Lead::create([
            'market_id' => $market->id,
            'request_type' => $type,
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'postal_code' => request('postal_code'),
            'visit_date' => request('visit_date'),
            'visit_length' => request('visit_length'),
            'num_adults' => request('num_adults'),
            'num_children' => request('num_children'),
            'interests' => request('interests'),
            'cookie_consent' => request('cookie_consent'),
            'freemail_consent' => request('freemail_consent'),
            'sdg_consent' => request('sdg_consent')
        ]);

        return $lead;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        //
    }
}
