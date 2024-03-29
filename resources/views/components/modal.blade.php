<div class="modal fade" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModalLabel" aria-hidden="true">
    <div class="modal-dialog @isset($modalSize) {{ $modalSize }} @endisset" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title d-flex" id="customModalLabel">{{ $title }}</h5>
            </div>
            <div class="modal-body py-4">
                @isset($descriptionText)
                    <p class="m-0">{{ $descriptionText }}</p>
                @endisset

                @isset ($body)
                    {!! $body !!}
                @endisset
            </div>
            <div class="modal-footer p-2">
                {{ $actionButtons }}
            </div>
        </div>
    </div>
</div>