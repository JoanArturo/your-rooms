@modal(['modalSize' => 'modal-lg'])

    @slot('title')
        <i class="ri-image-fill mr-1"></i> {{ __('Image preview') }}
    @endslot

    @slot('body')
        <img class="w-100" src="{{ asset('storage/' . $image->path) }}" alt="Image {{ $image->id }}">

        @if ($image->user == Auth::user())
            {!! Form::open(['url' => route('user.changeProfilePicture', ['user' => Auth::user()]), 'method' => 'put', 'class' => 'display: none', 'id' => 'profilePhotoChangeForm']) !!}
                {!! Form::hidden('image_path', $image->path) !!}
            {!! Form::close() !!}    
        @endif
    @endslot

    @slot('actionButtons')
        <button type="button" class="btn btn-outline-danger mr-auto"><i class="ri-delete-bin-5-fill mr-1"></i> {{ __('Remove from gallery') }}</button>
        <button type="button" class="btn btn-gray" data-dismiss="modal">{{ __('Close') }}</button>

        @if ($image->user == Auth::user())
            <button type="submit" class="btn btn-primary" form="profilePhotoChangeForm">{{ __('Use as profile photo') }}</button>
        @endif
    @endslot

@endmodal