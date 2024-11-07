<!--begin::Modal dialog-->
<div class="modal-dialog modal-lg modal-{{ $size ?? '' }} modal-dialog-centered" tabindex="-1" id="popup">
    <!--begin::Modal content-->
    <div class="modal-content">
        <!--begin::Modal header-->
        <div class="modal-header @else border-0 justify-content-end">
        
                <!--begin::Modal title-->
                <h2 class="fw-bold mb-0">{{ __('Thêm đơn hàng') }}</h2>
                <!--end::Modal title-->
        
            <!--begin::Close-->
            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                <i class="material-symbols-rounded fs-1">
                    close
                </i>
            </div>
            <!--end::Close-->
        </div>
        <!--end::Modal header-->
        <!--begin::Modal body-->
        <div class="modal-body p-0">
            
            @php
        $formId = 'F' . uniqid();
    @endphp

    <form id="{{ $formId }}" action="" method="post">
        @csrf

        @include('hk.domain._register_form')
        
        <div class="modal-footer flex-center">
            <!--begin::Button-->
            <button form-control="save" type="submit" class="btn btn-primary">
                <span class="indicator-label">{{ __('Lưu') }}</span>
                <span class="indicator-progress">{{ __('Đang xử lý...') }}
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
            <!--end::Button-->
            <!--begin::Button-->
            <button type="reset" id="kt_modal_add_contact_cancel" class="btn btn-light me-3"
                data-bs-dismiss="modal">{{ __('Hủy') }}</button>
            <!--end::Button-->
        </div>
    </form>

        </div>
        <!--end::Modal body-->
    </div>
    <!--end::Modal content-->
</div>
<!--end::Modal dialog-->