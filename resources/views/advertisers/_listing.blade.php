<div class="border-bottom mb-3">
	@include('categories._links', ['item' => $advertiser])
	<h5 class="text-advertiser card-title mb-0"><a href="{{ $advertiser->path() }}" class="text-reset">{{ $advertiser->name }}</a></h5>
	<div class="mt-0">{!! $advertiser->write_up !!}</div>
</div>