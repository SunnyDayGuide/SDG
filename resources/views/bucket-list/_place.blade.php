@php
$item = $bucket->advertisers()->where('id', $bucket_item->id)->first();
$notes = $item->pivot->notes;
@endphp
<bucket-item-card item-id="{{ $bucket_item->id }}" item-class="App\Advertiser" card-class="card-advertiser" item-notes="{{ $notes }}" item-completed="{{ $item->pivot->completed ? $item->pivot->completed : '0' }}">
	<template slot="image">
		<a href="{{ $bucket_item->path() }}">@include('partials._images', ['item' => $bucket_item])</a>
	</template>
	<template slot="title">
		<a href="{{ $bucket_item->path() }}" class="text-decoration-none">{{ $bucket_item->name }}</a>
	</template>
	<template slot="body">
		@include('bucket-list._place-locations', ['bucket_item' => $bucket_item])
	</template>
	<template slot="buttons">
		@include('bucket-list._place-buttons', ['bucket_item' => $bucket_item])
	</template>
</bucket-item-card>