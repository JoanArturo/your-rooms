@modal
    @slot('title')
        {{ __('Delete record') }}
    @endslot

    @slot('descriptionText')
        {!! __('Are you sure to delete the registration <strong>:name</strong>?', ['name' => $user->name]) !!}
    @endslot

    @slot('actionButtons')
        <button type="button" class="btn btn-gray" data-dismiss="modal">{{ __('No, cancel') }}</button>
        <button type="button" class="btn btn-danger" id="btn-confirm-deletion" data-url="{{ route('admin.user.destroy', $user) }}">{{ __('Yes, delete') }}</button>
    @endslot
@endmodal