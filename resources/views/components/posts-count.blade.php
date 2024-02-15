@props(['count'])

@if($count == 1) 1 article
@else {{ $count }} articles
@endif
