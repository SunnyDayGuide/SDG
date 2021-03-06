<?php

namespace App\Mail;

use App\Bucket;
use App\Market;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BucketListMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bucket;
    public $market;

    protected $theme = 'sdg';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Market $market, Bucket $bucket)
    {
        $this->bucket = $bucket;
        $this->market = $market;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $bucket = $this->bucket;

        $coupons = $bucket->coupons; 
        $events = $bucket->events;
        $articles = $bucket->articles;
        $shows = $bucket->shows;

        $advertiserIds = $bucket->advertisers()->pluck('id');

        // display the each category's advertisers
        $activities = $bucket->getAdvertisersByCategory(1, $advertiserIds);
        $restaurants = $bucket->getAdvertisersByCategory(2, $advertiserIds);
        $shops = $bucket->getAdvertisersByCategory(3, $advertiserIds);
        $entertainers = $bucket->getAdvertisersByCategory(4, $advertiserIds);
        $accommodations = $bucket->getLodgingList(); 

        return $this->subject('Your Vacation Bucket List')
                    ->markdown('emails.bucket-list', compact('coupons', 'events', 'articles', 'activities', 'restaurants', 'shops', 'entertainers', 'accommodations', 'shows', 'bucket'));
    }
}
