<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Market;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the form for creating a new contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $markets = Market::all();

        return view('contact-us.create', compact('markets'));
    }

    /**
     * Store a newly created contact in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (request('department') == 'advertiser') {
            $department = Contact::ADVERTISER_TYPE;
        } elseif (request('department') == 'distribution') {
            $department = Contact::DISTRIBUTION_TYPE;
        } else $department = Contact::OTHER_TYPE;

        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'market' => 'nullable|integer',
            'department' => 'required',
            'comment' => 'required',
            'sdg_consent' => 'boolean',
            'cookie_consent' => 'accepted',
            'verification' => 'required|size:5',
        ]);

        $contact = Contact::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'market_id' => $validatedData['market'],
            'contact_type' => $department,
            'comment' => $validatedData['comment'],
            'sdg_consent' => $validatedData['sdg_consent'],
            'cookie_consent' => $validatedData['cookie_consent'],
        ]);

        return redirect()->route('contact.show');
    }

}
