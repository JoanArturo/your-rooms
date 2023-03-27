@extends('layouts.app')

@section('page', __('Suggestions received'))

@section('content')
<div class="table-responsive rounded mt-4">
    <div class="table-header-options">
        <h5 class="table-title"><i class="ri-table-line ri-sm"></i> {{ __('Suggestions received') }}</h5>
        <div class="d-flex align-items-center">
            <form action="{{ route('admin.suggestion.index') }}" class="position-relative">
                <input type="text" placeholder="{{ __('Search') }}" name="search" class="form-control table-search-input" value="{{ request()->get('search') }}">
                <i class="ri-search-line"></i>
            </form>
        </div>
    </div>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">{{ __('User') }}</th>
                <th scope="col">{{ __('Message') }}</th>
                <th scope="col" width="15%">{{ __('Registration date') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suggestions as $suggestion)
                <tr>
                    <th scope="row">{{ $suggestion->id }}</th>
                    <td>{{ $suggestion->user->presenter()->name() }}</td>
                    <td>{{ $suggestion->body }}</td>
                    <td>{{ $suggestion->created_at->diffForHumans() }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">{{ __('Empty table') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $suggestions->links() }}
@endsection
