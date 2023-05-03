@extends('layouts.app')

@section('page', __('Rooms'))

@section('content-fluid')
    @empty(request('search'))
        <section class="mb-5 home-hero">
            <h1 class="mb-0 text-white text-center">{{ __('Join a random chat room and start chatting right now!') }}</h1>
            <a href="{{ route('room.joinUserARandomRoom') }}" class="btn btn-primary">
                <span>{{ __('Join Now') }}</span>
                <i class="ri-arrow-right-line ml-1"></i>
            </a>
        </section>
    @endempty
@endsection

@section('content')
    <p class="text-container-title">{{ __('Last rooms created') }}</p>
    <div class="row" id="rooms-list">
        @forelse ($rooms as $room)
            @cardroom(['room' => $room])
            @endcardroom
        @empty
            <div class="col-12">
                <strong>{{ __('There are no rooms that match the search ":text"', ['text' => request('search')]) }}</strong>
            </div>
        @endforelse
    </div>

    @if ($rooms->hasMorePages())
        <div class="text-center mb-4">
            <button class="btn btn-link" id="btn-load-more-rooms" data-current-page="{{ $rooms->currentPage() }}">
                {{ __('Load more rooms') }} <span>({{ $rooms->total() - $rooms->count() }})</span>
            </button>
        </div>
    @endif
@endsection