@php
$collectionName = $collectionName ?? 'slider';
$profile = $profile ?? 'card';
$random = $random ?? false; // default is false

if($random == true) {
	$image = $item->getMedia($collectionName)->random();
} else
$image = $item->getFirstMedia($collectionName);
@endphp

{{ $image($profile) }}