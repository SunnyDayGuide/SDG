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
     * Show the form for creating a new Lead.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Market $market)
    {
        // grab path to determine whether we are processing a guide reqiest or a generic request for information.
        // Goes to same form, different page
        $path = Request::capture()->path();
        $group = strtolower(explode("/", $path)[2]);

        $page = $market->pages()->where('slug', $group)->first();
        $mainImage = $page->getFirstMedia('slider');
        $cover = $market->getFirstMedia('cover');

        return view($group.'.create', compact('market', 'group', 'page', 'mainImage', 'cover'));
    }

    /**
     * Store a newly created Lead in storage.
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

        $validatedData = $request->validate([
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
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'postal_code' => $validatedData['postal_code'],
            'visit_date' => $validatedData['visit_date'],
            'visit_length' => request('visit_length'),
            'num_adults' => request('num_adults'),
            'num_children' => request('num_children'),
            'interests' => request('interests'),
            'cookie_consent' => $validatedData['cookie_consent'],
            'freemail_consent' => $validatedData['freemail_consent'],
            'sdg_consent' => $validatedData['sdg_consent']
        ]);

        if ($type == 'Guide Download') {
            return redirect()->route('vacation-guide.show', compact('market'));
        }
            
        return redirect()->route('request-information.show', compact('market'));
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\VacationGuide  $vacationGuide
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market)
    {
        return view('request-information.thanks', compact('market'));
    }

}
