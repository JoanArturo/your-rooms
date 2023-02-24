<div class="modal fade" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="customModalLabel">{{ $title }}</h5>
            </div>
            <div class="modal-body py-4">
                <p class="m-0">{{ $descriptionText }}</p>
            </div>
            <div class="modal-footer p-2">
                {{ $actionButtons }}
            </div>
        </div>
    </div>
</div>