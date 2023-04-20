@extends('layouts.app')

@section('page', __('Profile information'))

@section('content')
<div class="top-separate user-profile mb-5">
    <div class="user-profile-header">
        {{-- Avatar --}}
        {!! Form::open(['url' => route('user.uploadProfilePicture'), 'id' => 'profile-image-form', 'enctype' => 'multipart/form-data']) !!}
            <input type="file" name="profile_picture" id="image-input" class="image-input">
            <div class="d-inline-flex position-relative" id="profile-image-container">
                <label for="image-input" class="image-label mb-0" data-toggle="tooltip" title="{{ __('Profile picture') }}">
                    {{ $user->presenter()->profilePicture() }}
                </label>
                @isset ($user->profile_picture)
                    <button type="button" id="btn-delete-profile-image">
                        <svg width="8" height="8" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 10L0 9L4 5L0 1L1 0L5 4L9 0L10 1L6 5L10 9L9 10L5 6L1 10Z" fill="#330136"/>
                        </svg>
                        {{ __('Delete picture') }}
                    </button>
                @endisset
            </div>
        {!! Form::close() !!}
        
        {{-- User information --}}
        <div>
            <h5 class="mb-1 font-weight-bold">{{ $user->name }}</h5>
            <p class="mb-1">{{ __('validation.attributes.gender') }}: {{ $user->presenter()->gender() }}</p>
            <p class="mb-1">{{ __('He/She joined') }} {{ $user->presenter()->createdAt() }}</p>
        </div>
    </div>
    
    <ul class="nav nav-tabs" id="userProfileTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab" aria-controls="gallery" aria-selected="true">{{ __('Gallery') }}</a>
        </li>
        @if ($user->id == Auth::user()->id)
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ __('Profile data') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">{{ __('Other settings') }}</a>
            </li>
        @endif
    </ul>
    
    <div class="tab-content pt-5" id="userProfileTabContent">
        <div class="tab-pane fade show active" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
            <p id="photo-number-text">{!! __('<span>:number</span> photos in total', ['number' => $user->images->count()]) !!}</p>
            <div class="row no-gutters mb-3">
                @if ($user->id == Auth::user()->id)
                    <div class="col-6 col-md-2" id="col-upload-photo">
                        <button id="btn-show-modal-to-upload-photo" data-toggle="modal" data-target="#customModal">
                            <i class="ri-add-line"></i>
                            <span>{{ __('Upload photo') }}</span>
                        </button>
                    </div>
                @endif
                @forelse ($images as $image)
                    <div class="col-6 col-md-2">
                        <img src="{{ asset('storage/' . $image->path) }}" alt="Photo {{ $image->id }}" class="gallery-image" data-url="{{ route('image.show', $image) }}">
                    </div>
                @empty
                    <div class="col-6 col-md-2 d-flex align-items-center justify-content-center" id="col-no-images">
                        <p class="m-0">{{ __('No images') }}</p>
                    </div>
                @endforelse
            </div>
            {!! $images->links() !!}
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
                <div class="col-12 col-md-6">
                    {!! Form::model($user, ['url' => route('user.update', $user), 'method' => 'put', 'id' => 'user-profile-form']) !!}
                        <div class="form-group float-input">
                            {!! Form::text('name', null, ['id' => 'name-input', 'class' => 'form-control', 'required' => true, 'autofocus' => true]) !!}
                            {!! Form::label('name-input', __('validation.attributes.name')) !!}
                        </div>
                        
                        <div class="form-group float-input">
                            {!! Form::text('email', null, ['id' => 'email-input', 'class' => 'form-control', 'required' => true, 'disabled' => true]) !!}
                            {!! Form::label('email-input', __('validation.attributes.email')) !!}
                        </div>

                        <div class="form-group float-input">
                            {!! Form::select('gender', $genders, null, ['id' => 'gender-input', 'class' => 'select2-single']) !!}
                            {!! Form::label('gender-input', __('validation.attributes.gender')) !!}
                        </div>

                        <div class="form-group d-flex align-items-center">
                            <label for="color-input" class="mb-0">{{ __('Message color') }}</label>
                            <input type="color" name="message_color" id="color-input" class="ml-2" value="{{ $user->settings['message_color'] ?? '#000000' }}">
                        </div>

                        <button class="btn btn-block btn-primary" type="button" id="btn-save-profile-changes">{{ __('Save changes') }}</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="options-group">
                        <a class="btn btn-block btn-gray" href="{{ route('user.changePassword') }}">{{ __('Change password') }}</a>
                        <a class="btn btn-block btn-outline-danger m-0" href="{{ route('user.deactivateAccount') }}">{{ __('Deactivate account') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    {{-- Modal upload photos to gallery --}}
    @modal
        @slot('title')
            <i class="ri-camera-fill mr-1"></i> {{ __('Upload photo') }}
        @endslot
        
        @slot('descriptionText')
            {{ __('validation.attributes.photo') }}
        @endslot

        @slot('body')
            {!! Form::open(['url' => route('user.uploadPhoto'), 'enctype' => 'multipart/form-data', 'id' => 'photoUploadForm', 'class' => 'mt-2']) !!}
                {!! Form::file('photo', ['required' => true, 'accept' => 'image/png, image/jpeg']) !!}
            {!! Form::close() !!}
        @endslot

        @slot('actionButtons')
            <button type="button" class="btn btn-gray" data-dismiss="modal">{{ __('Cancel') }}</button>
            <button type="submit" class="btn btn-primary" form="photoUploadForm">{{ __('Upload') }}</button>
        @endslot
    @endmodal
@endsection
