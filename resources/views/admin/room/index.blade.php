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
                    <td>{{ $room->presenter()->createdAt() }}</td>
                    <td>
                        <a href="{{ route('admin.room.edit', $room) }}" class="btn btn-info table-btn"><i class="ri-pencil-line"></i>{{ __('Edit') }}</a>
                        <button type="button" class="btn btn-danger table-btn" data-toggle="modal" data-target="#deleteRecord"><i class="ri-delete-bin-line"></i> {{ __('Delete') }}</button>
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

<!-- Modal Delete -->
<div class="modal fade" id="deleteRecord" tabindex="-1" role="dialog" aria-labelledby="deleteRecordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="deleteRecordLabel">{{ __('Delete record') }}</h5>
            </div>
            <div class="modal-body py-4">
                <p class="m-0">{!! __('Are you sure to delete the registration <strong>:name</strong>?', ['name' => 'México']) !!}</p>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-gray" data-dismiss="modal">{{ __('No, cancel') }}</button>
                <button type="button" class="btn btn-danger">{{ __('Yes, delete') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection
