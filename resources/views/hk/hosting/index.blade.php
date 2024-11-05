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


<!-- Hero Section -->
<div class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="display-4 font-weight-bold">WEB HOSTING</h1>
            <p class="lead font-weight-light custom-font-size">Nền móng vững chắc cho website</p>
            <a href="#" class="btn btn-primary btn-lg font-weight-bold px-4 py-2">Tư Vấn Cho Tôi</a>
        </div>
        <div class="col-md-6">
            <div class="text-center">
                <img src="<?php echo home_url(); ?>/wp-content/uploads/2024/10/hosting.jpg" alt="Image" class="img-fluid rounded shadow-lg">


            </div>
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
                    <p class="card-text text-center">Quản trị toàn diện</p>
                    <h6 class="text-muted">Chỉ từ</h6>
                    <h3 class="text-primary font-weight-bold">381.000₫</h3>
                    <p class="text-muted text-center">/tháng</p>
                    <small>Tiết kiệm 15% với gói hàng năm</small>
                    <a href="#" class="btn btn-dark mt-3">Xem các gói</a>
                </div>
            </div>
        </div>

        
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h3 class="card-title">SEO</h3>
                    <p class="card-text text-center">Tốt cho SEO</p>
                    <h6 class="text-muted">Chỉ từ</h6>
                    <h3 class="text-primary font-weight-bold">142.000₫</h3>
                    <p class="text-muted text-center">/tháng</p>
                    <small>Tiết kiệm 15% với gói hàng năm</small>
                    <a href="#" class="btn btn-dark mt-3">Xem các gói</a>
                </div>
            </div>
        </div>

        
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h3 class="card-title">Nodejs</h3>
                    <p class="card-text text-center">Truy cập web dễ dàng</p>
                    <h6 class="text-muted">Chỉ từ</h6>
                    <h3 class="text-primary font-weight-bold">74.000₫</h3>
                    <p class="text-muted text-center">/tháng</p>
                    <small>Tiết kiệm 25% với gói hàng năm</small>
                    <a href="#" class="btn btn-dark mt-3">Xem các gói</a>
                </div>
            </div>
        </div>

        
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h3 class="card-title">Python</h3>
                    <p class="card-text">Nền tảng lập trình ứng dụng</p>
                    <h6 class="text-muted text-center">Chỉ từ</h6>
                    <h3 class="text-primary font-weight-bold">122.000₫</h3>
                    <p class="text-muted text-center">/tháng</p>
                    <small>Tiết kiệm 15% với gói hàng năm</small>
                    <a href="#" class="btn btn-dark mt-3">Xem các gói</a>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <a href="#" class="btn btn-primary btn-lg font-weight-bold">Tôi Cần Tư Vấn</a>
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
                    <button type="submit" class="btn btn-danger btn-block font-weight-bold">Tư Vấn Cho Tôi</button>
                </form>
                
            </div>
        </div>
    </div>
</div>

<script>

    </script>
{{-- @endsection --}}
