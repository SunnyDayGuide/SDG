@php
$collectionName = $collectionName ?? 'slider';
$profile = $profile ?? 'md-card';
@endphp

@foreach($item->getFirstMedia($collectionName) as $image)
    {{-- <a href="{{ $image->getUrl() }}">
        <img src="{{ $image->getUrl($profile) }}"/>
    </a> --}}
    {{ $image($profile) }}
@endforeach