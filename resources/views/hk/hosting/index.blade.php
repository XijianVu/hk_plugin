{{-- @extends('hk.site.layouts.main.app', [
    'menu' => 'internal',
])
@section('content') --}}
<style>
    .font-weight-light {
        font-weight: 300; 
    }

    .custom-font-size {
        font-size: 1.75rem;
    }
    
    .modal-dialog {
        max-width: 60%; 
        margin: 30px auto;
    }

    
    .modal-title {
        font-size: 24px;
        font-weight: 600;
        padding: 15px;
    }
    .modal-body {
        padding: 20px 40px;
    }
    .modal-footer {
        padding: 20px ;
    }

    
    .form-control {
        font-size: 16px;
        padding: 20px;
        border-radius: 8px;
    }

    
    label {
        font-weight: 600;
    }

    

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div data-container="hosting-manager">
    <div class="container my-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4 font-weight-bold">WEB HOSTING</h1>
                <p class="lead font-weight-light custom-font-size">Nền móng vững chắc cho website</p>
                
                <button data-action="register-hosting" class="btn btn-primary btn-lg font-weight-bold px-4 py-2">Tư Vấn Cho Tôi</button>
            </div>
            <div class="col-md-6">
                <div class="text-center">
                    <img src="<?php echo home_url(); ?>/wp-content/uploads/2024/10/hosting.jpg" alt="Image" class="img-fluid rounded shadow-lg">


                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="register-hosting-modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header">
                    <h4 data-control="modal-heading" class="modal-title">Đăng ký Web Hosting</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
    
                <!-- body -->
                <form method="POST" data-form="register-hosting-popup">
                    <div class="modal-body" data-control="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="required fs-6 fw-semibold mb-2">Họ tên:</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ tên" required>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="required fs-6 fw-semibold mb-2">SĐT:</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="required fs-6 fw-semibold mb-2">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                            </div>
                            <div class="form-group">
                                <label for="type" class="required fs-6 fw-semibold mb-2">Dịch vụ:</label>
                                
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select class=" form-control" 
                                        data-allow-clear="true" data-control="select2" 
                                        name="type" id="type" 
                                        data-dropdown-parent="#register-hosting-modal" required>
                                    <option value="" disabled selected>Chọn dịch vụ</option>
                                    <option value="nodejs">Node.js</option>
                                    <option value="seo">SEO</option>
                                    <option value="ecommerce">E-Commerce</option>
                                    <option value="wordpress-vip">Wordpress VIP</option>
                                    <option value="security">Website Security</option>
                                    <option value="design">Web Design</option>
                                    <option value="maintenance">Maintenance & Support</option>
                                    <option value="python">Python</option>
                                </select>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button data-action="save" type="submit" class="btn btn-danger btn-block font-weight-bold">Đăng ký</button>
                        {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button> --}}
                    </div>
                </form> 
    
               
            </div>
        </div>
    </div>
    <div class="container my-5">
        <h2 class="text-center mb-4 font-weight-bold">Lựa Chọn Gói Phù Hợp Với Doanh Nghiệp Bạn</h2>
        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h3 class="card-title">Wordpress VIP</h3>
                        <p class="card-text text-center text-nowrap">Quản trị toàn diện</p>
                        <h6 class="text-muted">Chỉ từ</h6>
                        <h3 class="text-primary font-weight-bold">381.000₫</h3>
                        <p class="text-muted text-center">/tháng</p>
                        <small>Tiết kiệm 15% với gói hàng năm</small>
                        <button data-action="register-hosting" type='wordpress-vip' class="btn btn-dark mt-3">Đăng ký</button>
                    </div>
                </div>
            </div>

            
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h3 class="card-title">SEO</h3>
                        <p class="card-text text-center text-nowrap">Tốt cho SEO</p>
                        <h6 class="text-muted">Chỉ từ</h6>
                        <h3 class="text-primary font-weight-bold">142.000₫</h3>
                        <p class="text-muted text-center">/tháng</p>
                        <small>Tiết kiệm 15% với gói hàng năm</small>
                        <button data-action="register-hosting" type='seo' class="btn btn-dark mt-3">Đăng ký</button>
                    </div>
                </div>
            </div>

            
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h3 class="card-title">Nodejs</h3>
                        <p class="card-text text-center text-nowrap">Truy cập web dễ dàng</p>
                        <h6 class="text-muted">Chỉ từ</h6>
                        <h3 class="text-primary font-weight-bold">74.000₫</h3>
                        <p class="text-muted text-center">/tháng</p>
                        <small>Tiết kiệm 25% với gói hàng năm</small>
                        <button data-action="register-hosting" type='nodejs' class="btn btn-dark mt-3">Đăng ký</button>
                    </div>
                </div>
            </div>

            
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h3 class="card-title">Python</h3>
                        <p class="card-text text-center text-nowrap">Nền tảng lập trình ứng dụng</p>
                        <h6 class="text-muted text-center">Chỉ từ</h6>
                        <h3 class="text-primary font-weight-bold">122.000₫</h3>
                        <p class="text-muted text-center">/tháng</p>
                        <small>Tiết kiệm 15% với gói hàng năm</small>
                        <button data-action="register-hosting" type='python' class="btn btn-dark mt-3">Đăng ký</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button data-action="register-hosting" class="btn btn-primary btn-lg font-weight-bold">Đăng ký</button>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h3 class="font-weight-bold">Bạn cần thiết kế website?</h3>
            <p class="lead">Đội ngũ chuyên gia của chúng tôi sẽ tư vấn và xây dựng website trọn gói dành cho bạn</p>
            <ul class="list-unstyled">
                <li class="mb-2"><i class="fas fa-check text-success"></i> Miễn phí hosting và tên miền.</li>
                <li class="mb-2"><i class="fas fa-check text-success"></i> Giao diện và chức năng tùy chỉnh.</li>
                <li class="mb-2"><i class="fas fa-check text-success"></i> Dễ dàng quản lý và sử dụng.</li>
            </ul>
        </div>
        <div class="col-md-6">
            <div class="card p-4 shadow-lg">
                <h3 class="mb-4">Vui lòng điền thông tin của bạn để được tư vấn miễn phí</h3>
                <form method="POST" data-form="register-hosting">
                    @csrf
                    <div class="form-group">
                        <label for="name">Họ tên:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ tên" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">SĐT:</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                    </div>
                    <div class="form-group">
                        <label for="type" class="required fs-6 fw-semibold mb-2">Dịch vụ:</label>
                        <select class="form-select form-control" 
                                data-allow-clear="true" data-control="select2" 
                                name="type" id="type" 
                                data-dropdown-parent="#register-hosting-modal" required>
                            <option value="" disabled selected>Chọn dịch vụ</option>
                            <option value="nodejs">Node.js</option>
                            <option value="seo">SEO</option>
                            <option value="ecommerce">E-Commerce</option>
                            <option value="hosting">Web Hosting</option>
                            <option value="security">Website Security</option>
                            <option value="design">Web Design</option>
                            <option value="maintenance">Maintenance & Support</option>
                            <option value="python">Python</option>
                        </select>
                    </div>
                    <button data-action="save" type="submit" class="btn btn-danger btn-block font-weight-bold">Tư Vấn Cho Tôi</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
<script>
    
    var RegisterFormPopup = class {
        constructor(options) {
            this.container = options.container;
            this.events();
        }

        getSaveBtn() {
            return this.container.find('[data-action="save"]')
        }

        getUrl() {
            return "{!! esc_url(get_site_url()) . '?page=hk&path=/hosting' !!}";
        }

        getSpinnerForm() {
            return this.container.find('[data-form="spinner"]')
        }

        showSpinner() {
            this.getSpinnerForm().removeClass('d-none');;
        }

        hideSpinner() {
            this.getSpinnerForm().addClass('d-none');;
        }

        events() {
            this.getSaveBtn().on('click', e => {
                e.preventDefault();
                this.showSpinner();

                const data = $(this.container).serialize();

                $.ajax({
                    url: this.getUrl(),
                    method: 'POST',
                    data: data
                }).done(res => {
                    this.hideSpinner();

                    HKTool.alert({
                        icon: 'success',
                        message: "Tạo đơn thành công!",
                        ok: () => {
                            window.location.reload();
                        }
                    })
                }).fail(res => {
                    this.hideSpinner();

                    HKTool.alert({
                        icon: 'error',
                        message: "Tạo đơn thất bại, vui lòng kiểm tra lại!",
                        ok: () => {
                            
                        }
                    })
                })
            })
        }
    }
    var HKTool = {
        alert: function(options) {
            if (!options.icon) {
                options.icon = 'success'
            }

            if (!options.textOk) {
                options.textOk = 'OK'
            }

            Swal.fire({
                html: options.message,
                icon: options.icon,
                buttonsStyling: false,
                confirmButtonText: options.textOk,
                allowEnterKey: true,
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            }).then((result) => {
                if (options.ok) {
                    options.ok();
                }
            });
        },

        confirm: function(options) {
            Swal.fire({
                title: 'Bạn chắc chứ?',
                text: options.message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy',
            }).then((result) => {
                if (result.isConfirmed) {
                    if (options.ok) {
                        options.ok();
                    }
                }

                if (result.isDismissed) {
                    if (options.cancel) {
                        options.cancel();
                    }
                }
                
            });
        },
        
        addPageLoadingEffect: function() {
            var element = document.createElement('div')
            element.innerHTML = `
                <div data-control="page-loading" style="
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0,0,0,0.1);
                    position: fixed;
                    top: 0;
                    left: 0;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 1000000;
                ">
                    <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `;
            document.body.appendChild(element);
        },

        removePageLoadingEffect: function() {
            document.querySelector('[data-control="page-loading"]').remove();
        },

        fixPopupLayers: function() {
            var initZIndex = 1000;

            $('.modal-backdrop:visible').each(function(index) {
                var zIndex = initZIndex + (index*10);

                $(this).css('z-index', zIndex);
            });

            var initZIndex = 1010;

            $('.modal:visible').each(function(index) {
                var zIndex = initZIndex + (index*10);

                $(this).css('z-index', zIndex);
            });
        },

        warning: function(options) {
            if (!options.icon) {
                options.icon = 'warning'
            }

            if (!options.textOk) {
                options.textOk = 'OK'
            }

            Swal.fire({
                text: options.message,
                icon: options.icon,
                buttonsStyling: false,
                confirmButtonText: options.textOk,
                allowEnterKey: true,
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            }).then((result) => {
                if (options.ok) {
                    options.ok();
                }
            });
        },
    };

    // RegisterModal class definition
    class RegisterModal {
        constructor({ container }) {
            this.container = container;
        }

        // Method to show the modal
        show() {
            this.container.modal('show');
        }

        // Method to hide the modal
        hide() {
            this.container.modal('hide');
        }
    }

    $(document).ready(() => {
        window.popups = {};
        window.popups.registerModal = new RegisterModal({
            container: $('#register-hosting-modal'),
        });

        // const hostingForm = new HostingForm({
        //     container: $('[data-form="register-hosting"]')
        // });
        new RegisterFormPopup({
            container: $('[data-form="register-hosting"]')
        })
        new RegisterFormPopup({
            container: $('[data-form="register-hosting-popup"]')
        })

        $('[data-action="register-hosting"]').on('click', function(event) {
            event.preventDefault();

            const selectedType = $(this).attr('type');

            if (selectedType) {
                $('#type').val(selectedType).trigger('change');
            } else {
                $('#type').val('').trigger('change');
            }

            window.popups.registerModal.show();
        });
    });
</script>

