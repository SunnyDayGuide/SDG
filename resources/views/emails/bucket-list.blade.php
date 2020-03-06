@component('mail::message')

<h1>{{ $bucket->name }}</h1>
@if($bucket->start_date && $bucket->end_date)
<h4>{{ $bucket->start_date->format('m/d/Y') }} - {{ $bucket->end_date->format('m/d/Y') }}</h4>
@endif

<ul>
@foreach($restaurants as $restaurant)
<li>{{ $restaurant->name }}</li>
@endforeach
</ul>

@component('mail::button', ['url' => url(route('bucket-list', [$market->slug, 'cookie' => $bucket->uuid]))])
Go to your Bucket
@endcomponent

@component('mail::footer')
<div>
	<div class="social pb-4 pt-2">
		<a href="{{ $market->brand->facebook }}" target="_blank" aria-label="View {{ $market->brand->name }}'s Facebook page"><i class="fab fa-facebook fa-lg" aria-hidden="true"></i></a>	
		<a href="{{ $market->brand->instagram }}" target="_blank" aria-label="View {{ $market->brand->name }}'s Instagram Feed"><i class="fab fa-instagram fa-lg" aria-hidden="true"></i></a>
		<a href="{{ $market->brand->twitter }}" target="_blank" aria-label="View {{ $market->brand->name }}'s Twitter Feed"><i class="fab fa-twitter fa-lg" aria-hidden="true"></i></a>
		<a href="https://youtube.com/sunnydayguide" target="_blank" aria-label="View {{ $market->brand->name }}'s YouTube Channel"><i class="fab fa-youtube fa-lg" aria-hidden="true"></i></a>				
	</div>
</div>
@endcomponent

@endcomponent