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
            
            {!! Form::open(['url' => route('user.deletePhoto', ['id' => $image]), 'method' => 'delete', 'class' => 'display: none', 'id' => 'deletePhotoForm']) !!}
            {!! Form::close() !!}    
        @endif
    @endslot

    @slot('actionButtons')
        @if ($image->user == Auth::user())
            <button type="submit" class="btn btn-outline-danger mr-auto" form="deletePhotoForm"><i class="ri-delete-bin-5-fill mr-1"></i> {{ __('Remove from gallery') }}</button>
        @endif

        <button type="button" class="btn btn-gray" data-dismiss="modal">{{ __('Close') }}</button>

        @if ($image->user == Auth::user())
            <button type="submit" class="btn btn-primary" form="profilePhotoChangeForm">{{ __('Use as profile photo') }}</button>
        @endif
    @endslot

@endmodal