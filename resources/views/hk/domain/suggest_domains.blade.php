@foreach ($domains as $domain)
    <div class="row d-flex justify-content-between my-auto align-items-center row-separator">
        <div class="col-md-3">
            <span style="font-weight: bold">{{ $domain['name'] }}</span>
        </div>
        
        <div class="col-md-3">
            <span>1 năm đầu</span>
        </div>

        <div class="col-md-3">
            <span>{{ $domain['price'] }} vnđ</span>
        </div>

        <div class="col-md-3">
            <button class="btn btn-info">Chọn mua</button>
        </div>
    </div>
@endforeach