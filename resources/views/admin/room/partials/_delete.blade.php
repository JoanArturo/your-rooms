<!-- Modal Delete -->
<div class="modal fade" id="deleteRecord" tabindex="-1" role="dialog" aria-labelledby="deleteRecordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="deleteRecordLabel">{{ __('Delete record') }}</h5>
            </div>
            <div class="modal-body py-4">
                <p class="m-0">{!! __('Are you sure to delete the registration <strong>:name</strong>?', ['name' => $room->name]) !!}</p>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-gray" data-dismiss="modal">{{ __('No, cancel') }}</button>
                <button type="button" class="btn btn-danger" id="btn-confirm-deletion" data-url="{{ route('admin.room.destroy', $room) }}">{{ __('Yes, delete') }}</button>
            </div>
        </div>
    </div>
</div>