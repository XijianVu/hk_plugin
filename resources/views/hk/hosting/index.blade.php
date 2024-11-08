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
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
                <form method="POST" action="<?php echo esc_url(get_site_url()); ?>?page=hk&path=/hosting">
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
                                <select class="form-select form-control" 
                                        data-allow-clear="true" data-control="select2" 
                                        name="type" id="type" 
                                        data-dropdown-parent="#register-hosting-modal" required>
                                    <option value="" disabled selected>Chọn dịch vụ</option>
                                    <option value="nodejs">Node.js</option>
                                    <option value="python">Node.js</option>
                                    <option value="seo">SEO</option>
                                    <option value="ecommerce">E-Commerce</option>
                                    <option value="wordpress-vip">Wordpress VIP</option>
                                    <option value="security">Website Security</option>
                                    <option value="design">Web Design</option>
                                    <option value="maintenance">Maintenance & Support</option>
                                </select>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-block font-weight-bold">Đăng ký</button>
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
                        <button data-action="seo" type='wordpress-vip' class="btn btn-dark mt-3">Đăng ký</button>
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
                        <button data-action="nodejs" type='wordpress-vip' class="btn btn-dark mt-3">Đăng ký</button>
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
                        <button data-action="python" type='wordpress-vip' class="btn btn-dark mt-3">Đăng ký</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <a href="#" class="btn btn-primary btn-lg font-weight-bold">Đăng ký</a>
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
                <form method="POST" action="<?php echo esc_url(get_site_url()); ?>?page=hk&path=/hosting">
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
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger btn-block font-weight-bold">Tư Vấn Cho Tôi</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
<script>
    
    window.popups = {};

    $(() => {
        window.popups.registerModal = new RegisterModal({
            container: $('#register-hosting-modal')
        });

    
        $('[data-action="register-hosting"]').click((event) => {
            event.preventDefault(); 
            
            const selectedType = $(event.currentTarget).attr('type');
        
            
            if (selectedType) {
                $('#type').val(selectedType).trigger('change');
            } else {
                $('#type').val('').trigger('change');
            }            
            window.popups.registerModal.show(); 
        });
    });

    class RegisterModal {
        constructor({ container }) {
            this.container = container;
        }

        show() {
            this.container.modal('show'); 
        }

        hide() {
            this.container.modal('hide'); 
        }
    }
</script>

