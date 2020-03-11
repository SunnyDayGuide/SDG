@php
$item = $bucket->articles()->where('id', $article->id)->first();
$notes = $item->pivot->notes;
@endphp

<div class="row no-gutters position-relative bucket-item bucket-item-print">
	<div class="col-md-4 mb-md-0">
		<a href="{{ $article->path() }}">@include('partials._images', ['item' => $article])</a>
	</div>

	<div class="col-md-8 position-static pl-md-0 d-flex flex-column">
		<div class="card-body pb-0 py-md-0 px-0 px-md-4">
			<h5 class="card-title mt-0 text-primary">
				{{ $article->title }}
			</h5>

			<p class="card-text">{{ $article->present()->excerpt }}</p>

			<div class="bucket-buttons my-4">
				<div><span class="font-weight-bolder text-uppercase">Read More:</span> <a class="text-reset" href="{{ $article->path() }}" target="_blank">{{ $article->path() }}</a></div>
			</div>

			@if($notes)
			<div class="bucket-notes">
				<strong>NOTES: </strong>{{ $notes }}
			</div>
			@endif
		</div> <!-- End Card Body -->
	</div>
</div> <!-- End Row / Card -->