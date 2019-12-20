<?php

namespace App\Http\Controllers;

use App\Event;
use App\Mail\EventSubmittedMail;
use App\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Market $market)
    {
        $page = $market->pages()->where('slug', 'events')->first();

        if (!$page) {
            abort(404);
        }

        $slides = $page->getMedia('slider');
        $image = $page->getFirstMedia('slider');

        $events = $market->events()->current()->active()
        ->orderBy('start_date', 'asc')->get();

        $searchCategories = $market->categories()
            ->isParent()
            ->with('searchSubcategories')->get();

        dd($this->tryToRecurr($market));

        return view('events.index', compact('market', 'page', 'events', 'slides', 'image', 'searchCategories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market, Event $event)
    {
        //
    }

    /**
     * Show the form for submitting an event.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Market $market)
    {
        $page = $market->pages()->where('slug', 'events')->first();

        if (!$page) {
            abort(404);
        }

        $slides = $page->getMedia('slider');
        $image = $page->getFirstMedia('slider');

        return view('events.submit-form', compact('market', 'page', 'slides', 'image'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Market $market)
    {
        // store form data
        $validatedData = request()->validate([
            'title' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'required',
            'location' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'cookie_consent' => 'required|boolean',
        ]);

        $event = [
            'title' => $validatedData['title'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'start_time' => request('start_time'),
            'end_time' => request('end_time'),
            'description' => $validatedData['description'],
            'location' => $validatedData['location'],
            'phone' => request('phone'),
            'website_url' => request('website_url'),
            'ticket_url' => request('ticket_url'),
            'facebook_url' => request('facebook_url'),
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'company' => request('company'),
            'cookie_consent' => 'Yes',
            'market' => $market->name,
        ];

        // mail something
        Mail::to('sdmedia@sunnydayguide.com')
            ->send(new EventSubmittedMail($event));

        return redirect()->route('events', $market->slug)->with('message', 'Thanks for submitting your event! It will be appear on our website soon.');
    }

    public function tryToRecurr($market)
    {
        if ($market->code == 'BR') {
            $timezone = 'America/Chicago';
        } else $timezone = 'America/New_York';

        $event = Event::find(14);
        $recurrence = $event->recurrences()->first();

        // $startDate   = new \DateTime('2013-01-31 20:00:00', new \DateTimeZone($timezone));
        $startDate   = new \DateTime($event->start_date, new \DateTimeZone($timezone));
        $rule        = new \Recurr\Rule('FREQ=MONTHLY;COUNT=5', $startDate, null, $timezone);

        // $rule = (new \Recurr\Rule)
        //     ->setStartDate($startDate)
        //     ->setTimezone($timezone)
        //     ->setCount($recurrence->count)
        //     ->setFreq($recurrence->freq)
        //     ->setInterval($recurrence->interval)
        //     ->setBySetPosition($recurrence->bysetpos)
        //     ->setByDay(explode(',', $recurrence->byweekday))
        //     ->setByMonthDay(explode(',', $recurrence->bymonthday))
        //     ->setByMonth(explode(',', $recurrence->bymonth))
        //     ->setUntil($recurrence->until)
        // ;

        $rule = (new \Recurr\Rule)
            ->setStartDate($startDate)
            ->setTimezone($timezone)
            ->setFreq($recurrence->freq)
            ->setInterval($recurrence->interval)
            ->setBySetPosition(explode(',', $recurrence->bysetpos))
            ->setByDay(explode(',', $recurrence->byweekday))
            ->setUntil($recurrence->until)
        ; dd($rule->getString());

        $transformer = new \Recurr\Transformer\ArrayTransformer();

        $transformerConfig = new \Recurr\Transformer\ArrayTransformerConfig();
        $transformerConfig->enableLastDayOfMonthFix();
        $transformer->setConfig($transformerConfig);

        // print_r($transformer->transform($rule));

        return $transformer->transform($rule);
    }

}
