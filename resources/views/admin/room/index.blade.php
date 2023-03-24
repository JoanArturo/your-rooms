@extends('layouts.app')

@section('page', __('Rooms'))

@section('content')
<div class="table-responsive rounded mt-4">
    <div class="table-header-options">
        <h5 class="table-title"><i class="ri-table-line ri-sm"></i> {{ __('Rooms') }}</h5>
        <div class="d-flex align-items-center">
            <form action="{{ route('admin.room.index') }}" class="position-relative">
                <input type="text" placeholder="{{ __('Search') }}" name="search" class="form-control table-search-input" value="{{ request()->get('search') }}">
                <i class="ri-search-line"></i>
            </form>
            <a href="{{ route('admin.room.create') }}" class="table-button-add ml-2">
                <i class="ri-add-line"></i> {{ __('New') }}
            </a>
        </div>
    </div>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">{{ __('validation.attributes.name') }}</th>
                <th scope="col" width="30%">{{ __('validation.attributes.description') }}</th>
                <th scope="col">{{ __('validation.attributes.limit') }}</th>
                <th scope="col">{{ __('Users online') }}</th>
                <th scope="col">{{ __('Room status') }}</th>
                <th scope="col">{{ __('Registration date') }}</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rooms as $room)
                <tr>
                    <th scope="row">{{ $room->id }}</th>
                    <td>{{ $room->presenter()->name() }}</td>
                    <td>{{ $room->description }}</td>
                    <td>{{ $room->limit }}</td>
                    <td>{{ $room->presenter()->usersOnlineNumberWithIndicator() }}</td>
                    <td>{{ $room->presenter()->status() }}</td>
                    <td>{{ $room->presenter()->createdAt() }}</td>
                    <td>
                        <a href="{{ route('admin.room.edit', $room) }}" class="btn btn-info table-btn"><i class="ri-pencil-line"></i>{{ __('Edit') }}</a>
                        <button type="button" class="btn btn-danger table-btn btn-delete-record" data-url="{{ route('admin.room.delete', $room) }}"><i class="ri-delete-bin-line"></i> {{ __('Delete') }}</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">{{ __('Empty table') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $rooms->links() }}
</div>
@endsection
