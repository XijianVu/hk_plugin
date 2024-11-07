@foreach ($domains as $domain)
    <div data-control="domain-item" data-url="<?php echo esc_url(get_site_url()); ?>?page=hk&path=/hk/register-form" class="row d-flex justify-content-between my-auto align-items-center row-separator">
        <div class="col-md-3">
            <span data-control="domain-name" style="font-weight: bold">{{ $domain['name'] }}</span>
        </div>
        
        <div class="col-md-3">
            <span>1 năm đầu</span>
        </div>

        <div class="col-md-3">
            <span data-control="domain-price">{{ $domain['price'] }} vnđ</span>
        </div>

        <div class="col-md-3">
            <button data-action="buy-btn" class="btn btn-info">Chọn mua</button>
        </div>
    </div>
@endforeach