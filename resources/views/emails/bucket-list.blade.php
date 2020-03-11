@component('mail::message')
<p>Whether you're reserving an activity time, a restaurant table or show tickets, book directly by contacting the places in your bucket list! We've made it easy by providing phone numbers and web addresses for each item.</p>
<h1 style="margin-bottom: 0; color: #FF6F61;">{{ $bucket->name }}</h1>
@if($bucket->start_date && $bucket->end_date)
<h3 style="font-weight: normal">{{ $bucket->start_date->format('m/d/Y') }} - {{ $bucket->end_date->format('m/d/Y') }}</h3>
@endif

@if($coupons->count() > 0)
<h2 class="section-header">Coupons</h2>
@foreach($coupons as $coupon)
@include('bucket-list.email._coupon')
@endforeach
@endif

@if($activities->count() > 0 || $events->count() > 0)
<h2 class="section-header">Things to Do</h2>
@foreach($activities as $activity)
@include('bucket-list.email._place', ['bucket_item' => $activity])
@endforeach
@foreach($events as $event)
@include('bucket-list.email._event')
@endforeach
@endif

@if($restaurants->count() > 0)
<h2 class="section-header">Restaurants &amp; Dining</h2>
@foreach($restaurants as $restaurant)
@include('bucket-list.email._place', ['bucket_item' => $restaurant])
@endforeach
@endif

@if($shops->count() > 0)
<h2 class="section-header">Shopping</h2>
@foreach($shops as $shop)
@include('bucket-list.email._place', ['bucket_item' => $shop])
@endforeach
@endif

@if($entertainers->count() > 0 || $shows->count() > 0)
<h2 class="section-header">Entertainment &amp; Shows</h2>
@foreach($entertainers as $entertainer)
@include('bucket-list.email._place', ['bucket_item' => $entertainer])
@endforeach
@foreach($shows as $show)
@include('bucket-list.email._show')
@endforeach
@endif

@if($accommodations->count() > 0)
<h2 class="section-header">Places to Stay</h2>
@foreach($accommodations as $accommodation)
@include('bucket-list.email._place', ['bucket_item' => $accommodation])
@endforeach
@endif

@if($articles->count() > 0)
<h2 class="section-header">Trip Ideas/Visitor Info</h2>
@foreach($articles as $article)
@include('bucket-list.email._article')
@endforeach
@endif

@component('mail::button', ['url' => url(route('bucket-list', [$market->slug, 'cookie' => $bucket->uuid])), 'color' => 'highlight'])
Go to your Bucket
@endcomponent

@endcomponent