<div class="row bucket-item bucket-item-print">
	<div class="card-body p-0">
		<h5 class="text-primary card-title mb-0">{{ $show->name }}</h5>

		<div class="locations">
			<p>{{ $show->theater->name }}</p>
			<ul class="fa-ul">
				<li class="mb-2"><a href="{{ $show->theater->directions }}" target="_blank" aria-label="Get directions to {{ $show->theater->name }}"><span class="fa-li"><i class="fas fa-map-marker-alt fa-lg mr-2"></i></span>{{ $show->theater->full_address }}</a></li>
				@isset($show->local_phone)
				<li><a href="tel:{{ $show->local_phone }}" aria-label="Call {{ $show->name }}"><span class="fa-li"><i class="fas fa-phone fa-lg mr-2"></i></span>{{ $show->local_phone }}</a>@endisset
					@isset($show->toll_free)
					<a class="ml-5" href="tel:{{ $show->toll_free }}" aria-label="Call {{ $show->name }}">Call Toll-Free: {{ $show->toll_free }}</a>
					@endisset
				</li>
			</ul>
		</div>

		<div class="bucket-buttons my-3">
			<div><span class="font-weight-bolder text-uppercase">Show Schedule:</span> <a class="text-reset" href="{{ $show->path() }}" target="_blank">{{ $show->path() }}</a></div>
			@if($show->website_url)
			<div><span class="font-weight-bolder text-uppercase">Website:</span> <a class="text-reset" href="{{ $show->website_url }}" target="_blank">{{ $show->website_url }}</a></div>
			@endif
		</div>

		<div class="bucket->notes">
			{{ $notes }}
		</div>
	</div>
</div>