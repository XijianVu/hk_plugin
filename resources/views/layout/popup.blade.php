<div class="modal-dialog modal-lg modal-{{ $size ?? '' }} modal-dialog-centered" tabindex="-1" id="popup">
    <div class="modal-content">
        <div class="modal-header @hasSection('title') @else border-0 justify-content-end @endif">
            @hasSection('title')
                <h2 class="fw-bold mb-0">@yield('title')</h2>
            @endif
            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                <i class="material-symbols-rounded fs-1">
                    {{ __('close') }}
                </i>
            </div>
        </div>
        <div class="modal-body p-0">
            
            @yield('content')

        </div>
    </div>
</div>