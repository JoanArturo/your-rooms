@extends('layouts.app')

@section('page', __('Rooms'))

@section('content')
<p class="text-container-title">{{ __('Last rooms created') }}</p>
<div class="row" id="rooms-list">
    @foreach ($rooms as $room)
        @cardroom(['room' => $room])
        @endcardroom
    @endforeach
</div>

    @if ($rooms->hasMorePages())
        <div class="text-center mb-4">
            <button class="btn btn-link" id="btn-load-more-rooms" data-current-page="{{ $rooms->currentPage() }}">
                {{ __('Load more rooms') }} <span>({{ $rooms->total() - $rooms->count() }})</span>
            </button>
        </div>
    @endif
@endsection