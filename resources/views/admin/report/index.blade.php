@extends('layouts.app')

@section('page', __('Reports received'))

@section('content')
<div class="table-responsive rounded mt-4">
    <div class="table-header-options">
        <h5 class="table-title"><i class="ri-table-line ri-sm"></i> {{ __('Reports received') }}</h5>
        <div class="d-flex align-items-center">
            <form action="{{ route('admin.report.index') }}" class="position-relative">
                <input type="text" placeholder="{{ __('Search') }}" name="search" class="form-control table-search-input" value="{{ request()->get('search') }}">
                <i class="ri-search-line"></i>
            </form>
        </div>
    </div>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">{{ __('Reporting user') }}</th>
                <th scope="col">{{ __('Subject') }}</th>
                <th scope="col">{{ __('Reported message') }}</th>
                <th scope="col" width="15%">{{ __('Message from') }}</th>
                <th scope="col">{{ __('Room') }}</th>
                <th scope="col" width="10%">{{ __('Registration date') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reports as $report)
                <tr>
                    <th scope="row">{{ $report->id }}</th>
                    <td>{{ $report->user->presenter()->name() }}</td>
                    <td>{{ __('Report inappropriate message/content') }}</td>
                    <td>{{ $report->message->body }}</td>
                    <td>
                        <p class="m-0">{{ $report->message->user->presenter()->name() }}</p>
                        <small>{{ __('Num. reports') }}: {{ $report->message->user->number_of_reports_against }}</small>
                        <div>
                            <small class="mr-1">{{ __('validation.attributes.account_status') }}:</small>
                            {{ $report->message->user->presenter()->status() }}
                        </div>
                    </td>
                    <td>{{ $report->message->room->presenter()->name() }}</td>
                    <td>{{ $report->created_at->diffForHumans() }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">{{ __('Empty table') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $reports->links() }}
@endsection
