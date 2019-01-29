@php
$collectionName = $collectionName ?? 'slider';
$profile = $profile ?? 'card';
$image = $item->getFirstMedia($collectionName);
@endphp

{{ $image($profile) }}