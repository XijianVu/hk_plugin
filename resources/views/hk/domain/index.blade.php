<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<style>
    .spinner {
        border: 3px solid #f3f3f3;
        border-top: 3px solid #3498db;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div data-container="domain-manager" class="container my-5">
    <div class="row text-center mb-5">
        <div class="col-md-12 mb-2">
            <h2 class="display-5 text-primary text-uppercase fw-bold letter-spacing">Kiểm Tra Và Đăng Ký Tên Miền Ngay Hôm Nay</h2>
            <p class="text-muted fs-5 fst-italic mb-0 text-center">Tìm tên miền hoàn hảo cho doanh nghiệp hoặc thương hiệu cá nhân của bạn</p>
        </div>

        <style>
            form {
                margin: auto;
            }

            .form-group label {
                color: #333;
            }

            .input-group-text {
                font-weight: 500;
                color: #777;
            }

            .form-control {
                padding: 0.75
                font-size: 1rem;rem 1.25rem;
                font-size: 1rem;
                border-radius: 8px;
            }

            .form-control:focus {
                background-color: #f3f3f3;
                border-color: #80bdff;
                box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
            }

            .btn-success {
                padding: 0.75rem 0;
                font-size: 1.2rem;
                font-weight: bold;
                transition: background-color 0.3s ease, box-shadow 0.3s ease;
            }

            .btn-success:hover {
                background-color: #28a745cc;
                box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
            }

            body {
                background: #f5f5f5
            }
            
            .rounded {
                border-radius: 1rem
            }
            
            .nav-pills .nav-link { 
                color: #555
            } 
            .nav-pills .nav-link.active {
                color: white
            }
            
            input[type="radio"] {
                margin-right: 5px
            }
            
            .bold {
                font-weight:bold
            }
        </style>
        
        <!-- The Modal -->
        <div class="modal" id="register-modal">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 data-control="modal-heading" class="modal-title">Modal Heading</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
        
                    <!-- Modal body -->
                    <div class="modal-body" data-control="modal-body">
                        
                    </div>
        
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 mx-auto" data-form="search-domain" data-url="<?php echo esc_url(get_site_url()); ?>?page=hk&path=/hk/search-domain">
            @csrf
            <div class="row py-3">
                <div class="col-md-12">
                    <input type="search" data-action="search-input" class="form-control py-4" placeholder="Nhập tên miền bạn cần tại đây" />
                </div>
            </div>

            <div data-form="validation" class="mb-3">
                {{-- VALID --}}
                <div data-control="valid-form" class="">
                    <span class="fw-bold text-success">Tuyệt vời! Bạn có thể đăng ký với tên miền này</span>
                    <div class="row d-flex justify-content-between mt-3 align-items-center">
                        <div class="col-md-3">
                            <span data-control="available-domain" style="font-weight: bold">#N/A</span>
                        </div>
                        
                        <div class="col-md-3">
                            <span>1 năm</span>
                        </div>
                
                        <div class="col-md-3">
                            <span>249.000 vnđ</span>
                        </div>
                
                        <div class="col-md-3">
                            <button class="btn btn-success">Chọn mua</button>
                        </div>
                    </div>
                </div>
    
                {{-- INVALID --}}
                <div data-control="invalid-form">
                    <span class="fw-bold text-danger" data-control="error-text">Domain đã được đăng ký</span>
                </div>
            </div>

            <hr>

            <div style="padding: 20px">
                <style>
                    .row-separator {
                        border-bottom: 1px solid #dee2e6;
                        padding: 10px 0;
                    }
                
                    .row-separator:not(:last-child) {
                        border-bottom: 1px solid #dee2e6;
                    }
                </style>

                <div data-form="suggest-domains" data-action="<?php echo esc_url(get_site_url()); ?>?page=hk&path=/hk/suggest-domains" class="mt-2">
                    <div class="row mb-3">
                        <div class="col-md-12 col-12 mb-3">
                            <span class="fw-bold text-dark fs-3" style="font-weight: bold">Gợi ý dành cho bạn:</span>
                        </div>

                        <div data-form="items-box" class="col-md-12 col-12">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            window.popups = {};
            var registerModal;

            $(() => {
                registerModal = new RegisterModal({
                    container: $('#register-modal')
                });

                new DomainManager({
                    container: $('[data-container="domain-manager"]')
                })
            });

            var RegisterModal = class {
                constructor(options) {
                    this.container = options.container;
                }

                show() {
                    $(this.container).modal('show');
                }

                hide() {
                    $(this.container).modal('hide');
                }

                getHeading() {
                    return this.container.find('[data-control="modal-heading"]');
                }

                getBody() {
                    return this.container.find('[data-control="modal-body"]');
                }

                setHeading(heading) {
                    this.getHeading().html(heading)
                }

                setBody(body) {
                    this.getBody().html(body);
                }
            }

            var DomainManager = class {
                constructor(options) {
                    this.container = options.container;
                    this.searchManager = new DomainSearchManager({
                        container: $('[data-form="search-domain"]'),
                        manager: this
                    });
                    this.suggestBox = new SuggestBox({
                        container: $('[data-form="suggest-domains"]'),
                        manager: this
                    });
                }

                handleSuggest() {
                    const searchValue = this.searchManager.getSearchValue();
                    this.suggestBox.suggest(searchValue);
                }
            }

            var ValidationBox = class {
                constructor(options) {
                    this.container = options.container;
                }

                hideAll() {
                    this.hideValidForm();
                    this.hideInvalidForm();
                }

                getValidForm() {
                    return this.container.find('[data-control="valid-form"]')
                }

                getInvalidForm() {
                    return this.container.find('[data-control="invalid-form"]')
                }

                getErrorTextForm() {
                    return this.getInvalidForm().find('[data-control="error-text"]');
                }

                setErrorText(text) {
                    this.getErrorTextForm().html(text);
                }

                hideValidForm() {
                    this.getValidForm().hide();
                }

                showValidForm() {
                    this.getValidForm().show();
                }

                hideInvalidForm() {
                    this.getInvalidForm().hide();
                }

                showInValidForm() {
                    this.getInvalidForm().show();
                }

                handleValid(availableDomain) {
                    this.setAvailableDomain(availableDomain);
                    this.hideInvalidForm();
                    this.showValidForm();
                }

                handleInvalid() {
                    this.setAvailableDomain(null);
                    this.hideValidForm();
                    this.showInValidForm();
                }

                getAvailabledDomainSpan() {
                    return this.container.find('[data-control="available-domain"]');
                }

                setAvailableDomain(availableDomain) {
                    this.getAvailabledDomainSpan().html(availableDomain);
                }
            }
        
            var DomainSearchManager = class {
                constructor(options) {
                    this.container = options.container;
                    this.validationBox = new ValidationBox({
                        container: $('[data-form="validation"]')
                    });
                    this.manager = options.manager;

                    this.init();
                }

                getSearchUrl() {
                    return this.container.attr('data-url')
                }

                getSearchInput() {
                    return this.container.find('[data-action="search-input"]');
                }
        
                getSearchValue() {
                    return this.getSearchInput().val();
                }
        
                debounce(func, delay) {
                    let timeout;
                    return function (...args) {
                        clearTimeout(timeout);
                        timeout = setTimeout(() => func.apply(this, args), delay);
                    };
                }

                init() {
                    this.validationBox.hideAll();
                    this.events();
                }

                search() {
                    const value = this.getSearchValue();
                    const url = this.getSearchUrl();

                    if (value == "") {
                        this.validationBox.setErrorText("")
                        this.validationBox.hideAll();
                    } else {
                        $.ajax({
                            url: url,
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                value: value
                            }
                        }).done(res => {
                            this.validationBox.handleValid(value);
                        }).fail(res => {
                            const errorText = JSON.parse(res.responseText).message;
                            this.validationBox.setErrorText(errorText)
                            this.validationBox.handleInvalid();
                        }).always(() => {
                            this.manager.handleSuggest(value);
                        })
                    }
                }
        
                events() {
                    const debouncedLog = this.debounce((value) => {
                        this.search();
                    }, 500);
        
                    this.getSearchInput().on('input', e => {
                        e.preventDefault();

                        this.validationBox.hideAll()

                        const value = this.getSearchValue();

                        debouncedLog(value);
                    });
                }
            }

            var SuggestBox = class {
                constructor(options) {
                    this.container = options.container;
                    this.manager = options.manager;

                    this.suggest();
                }

                getItemsBox() {
                    return this.container.find('[data-form="items-box"]');
                }

                getHtmlItems() {
                    return this.getItemsBox().find('[data-control="domain-item"]');
                }

                getSuggestUrl() {
                    return this.container.attr('data-action');
                }

                addSpinner() {
                    this.getItemsBox().html(
                        `
                            <div class="spinner m-auto"></div>
                        `
                    );
                }

                removeSpinner() {
                    this.getItemsBox().find('.spinner').remove();
                }

                addItems(res) {
                    this.getItemsBox().html(res);
                    this.generateItems();
                }

                generateItems() {
                    const htmlItems = this.getHtmlItems();

                    htmlItems.each((i, htmlItem) => {
                        new SuggestedDomain({
                            container: htmlItem
                        })
                    });
                }
                
                suggest(searchValue = null) {
                    const url = this.getSuggestUrl();

                    this.addSpinner();

                    $.ajax({
                        url: url,
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            searchValue: searchValue
                        }
                    }).done(res => {
                        this.removeSpinner();
                        this.addItems(res);
                    }).fail(res => {
                        console.error(res);
                    })
                }
            }

            var SuggestedDomain = class {
                constructor (options) {
                    this.container = options.container;

                    this.events();
                }

                getBuyBtn() {
                    return $(this.container).find('[data-action="buy-btn"]')
                }

                getUrl() {
                    return $(this.container).attr('data-url');
                }

                getName() {
                    return $(this.container).find('[data-control="domain-name"]').html();
                }

                getPrice() {
                    return $(this.container).find('[data-control="domain-price"]').html();
                }

                formatPrice(priceString) {
                    const priceNumber = priceString.replace(/\D/g, ''); 
                    const formattedPrice = Number(priceNumber).toLocaleString('en-US'); 

                    return formattedPrice;
                }

                setupModalBody() {
                    const name = this.getName();
                    const price = this.getPrice();
                    const formatedPrice = this.formatPrice(price);

                    return `
                        <form action="" class="p-4 rounded shadow-sm bg-light w-100">
                            <style>
                                .mobile-text {
                                    color: #989696b8;
                                    font-size: 15px;
                                }

                                .form-control {
                                    margin-right: 12px;
                                }

                                .cursor {
                                    cursor: pointer;
                                }
                            </style>
                            <div class="d-flex justify-content-center align-items-center container">
                                <div class="px-3">
                                    <h2 class="m-0 mb-2 text-bold">${name}</h2><span class="mobile-text">Sở hữu tên miền <u><b class="text-danger">${name}</b></u> với <b class="text-danger">${formatedPrice} VNĐ</b>/Năm đầu tiên</span>
                                </div>
                            </div>

                            <div class="text-center">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12 w-100 mx-auto">
                                            <div class="">
                                                <div class="">
                                                    <div class="pt-4 pl-2 pr-2 pb-2">
                                                        <!-- Credit card form tabs -->
                                                        <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                                                            <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active "> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li>
                                                            <li class="nav-item"> <a data-toggle="pill" href="#paypal" class="nav-link "> <i class="fab fa-paypal mr-2"></i> Paypal </a> </li>
                                                            <li class="nav-item"> <a data-toggle="pill" href="#net-banking" class="nav-link "> <i class="fas fa-mobile-alt mr-2"></i> Net Banking </a> </li>
                                                        </ul>
                                                    </div> <!-- End -->
                                                    <!-- Credit card form content -->
                                                    <div class="tab-content">
                                                        <!-- credit card info-->
                                                        <div id="credit-card" class="tab-pane fade show active pt-3">
                                                            <form role="form" onsubmit="event.preventDefault()">
                                                                <div class="form-group"> <label for="username">
                                                                        <h6>Card Owner</h6>
                                                                    </label> <input type="text" name="username" placeholder="Card Owner Name" required class="form-control "> </div>
                                                                <div class="form-group"> <label for="cardNumber">
                                                                        <h6>Card number</h6>
                                                                    </label>
                                                                    <div class="input-group"> <input type="text" name="cardNumber" placeholder="Valid card number" class="form-control " required>
                                                                        <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <div class="form-group"> <label><span class="hidden-xs">
                                                                                    <h6>Expiration Date</h6>
                                                                                </span></label>
                                                                            <div class="input-group"> <input type="number" placeholder="MM" name="" class="form-control" required> <input type="number" placeholder="YY" name="" class="form-control" required> </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                                                <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                                                            </label> <input type="text" required class="form-control"> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="footer"> <button type="button" class="subscribe btn btn-primary btn-block shadow-sm">Xác nhận thanh toán</button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <div id="paypal" class="tab-pane fade pt-3">
                                                        <h6 class="pb-2">Chọn loại tài khoản PayPal của bạn</h6>
                                                        <div class="form-group">
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="domestic" name="optradio" class="custom-control-input" checked>
                                                                <label class="custom-control-label" for="domestic">Domestic</label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="international" name="optradio" class="custom-control-input">
                                                                <label class="custom-control-label" for="international">International</label>
                                                            </div>
                                                        </div>
                                                        <p>
                                                            <button type="button" class="btn btn-primary">
                                                                <i class="fab fa-paypal mr-2"></i>Đăng nhập vào Paypal
                                                            </button>
                                                        </p>
                                                        <p class="text-muted">
                                                            Lưu ý: Sau khi nhấp vào nút, bạn sẽ được chuyển đến cổng thanh toán bảo mật. Sau khi hoàn tất quá trình thanh toán, bạn sẽ được chuyển lại về trang web để xem chi tiết đơn hàng của mình.
                                                        </p>
                                                    </div>

                                                    <!-- bank transfer info -->
                                                    <div id="net-banking" class="tab-pane fade pt-3">
                                                        <div class="form-group "> <label for="Tài khoản ngân hàng">
                                                                <h6>Chọn ngân hàng</h6>
                                                            </label> <select class="form-control" id="ccmonth">
                                                                <option value="" selected disabled>--Chọn ngân hàng của bạn--</option>
                                                                <option>Vietinbank</option>
                                                                <option>Vietcombank</option>
                                                                <option>Techcombank</option>
                                                                <option>Agribank</option>
                                                            </select> </div>
                                                        <div class="form-group">
                                                            <p> <button type="button" class="btn btn-primary "><i class="fas fa-mobile-alt mr-2"></i>Tiến hành thanh toán</button> </p>
                                                        </div>
                                                        <p class="text-muted">Lưu ý: Sau khi nhấp vào nút, bạn sẽ được chuyển đến cổng thanh toán bảo mật. Sau khi hoàn tất quá trình thanh toán, bạn sẽ được chuyển lại về trang web để xem chi tiết đơn hàng của mình.</p>
                                                    </div> <!-- End -->
                                                    <!-- End -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </form>
                    `
                }

                events() {
                    this.getBuyBtn().on('click', e => {
                        e.preventDefault();

                        const url = this.getUrl();

                        registerModal.setHeading("Thanh toán tên miền");
                        registerModal.setBody(this.setupModalBody());
                        registerModal.show();
                    })
                }
            }
        </script>

        <div class="col-md-12 mt-5">
            <div class="row d-flex justify-content-around">
                <button class="btn btn-outline-secondary text-dark fw-semibold col-md-2 mx-4 my-2 badge badge-info border-0 py-2">
                    <span class="badge badge-info fw-bold" style="font-size: 15px">.vn</span>&nbsp;
                    <span class="text-white badge badge-info fw-bold" style="font-size: 15px">500.000 VND</span>
                </button>

                <button class="btn btn-outline-secondary text-dark fw-semibold col-md-2 mx-4 my-2 badge badge-info border-0 py-2">
                    <span class="badge badge-info fw-bold" style="font-size: 15px">.com</span>&nbsp;
                    <span class="text-white badge badge-info fw-bold" style="font-size: 15px">500.000 VND</span>
                </button>

                <button class="btn btn-outline-secondary text-dark fw-semibold col-md-2 mx-4 my-2 badge badge-info border-0 py-2">
                    <span class="badge badge-info fw-bold" style="font-size: 15px">.net</span>&nbsp;
                    <span class="text-white badge badge-info fw-bold" style="font-size: 15px">500.000 VND</span>
                </button>

                <button class="btn btn-outline-secondary text-dark fw-semibold col-md-2 mx-4 my-2 badge badge-info border-0 py-2">
                    <span class="badge badge-info fw-bold" style="font-size: 15px">.org</span>&nbsp;
                    <span class="text-white badge badge-info fw-bold" style="font-size: 15px">500.000 VND</span>
                </button>

                <button class="btn btn-outline-secondary text-dark fw-semibold col-md-2 mx-4 my-2 badge badge-info border-0 py-2">
                    <span class="badge badge-info fw-bold" style="font-size: 15px">.edu</span>&nbsp;
                    <span class="text-white badge badge-info fw-bold" style="font-size: 15px">500.000 VND</span>
                </button>

                <button class="btn btn-outline-secondary text-dark fw-semibold col-md-2 mx-4 my-2 badge badge-info border-0 py-2">
                    <span class="badge badge-info fw-bold" style="font-size: 15px">.au</span>&nbsp;
                    <span class="text-white badge badge-info fw-bold" style="font-size: 15px">500.000 VND</span>
                </button>

                <button class="btn btn-outline-secondary text-dark fw-semibold col-md-2 mx-4 my-2 badge badge-info border-0 py-2">
                    <span class="badge badge-info fw-bold" style="font-size: 15px">.ha</span>&nbsp;
                    <span class="text-white badge badge-info fw-bold" style="font-size: 15px">500.000 VND</span>
                </button>

                <button class="btn btn-outline-secondary text-dark fw-semibold col-md-2 mx-4 my-2 badge badge-info border-0 py-2">
                    <span class="badge badge-info fw-bold" style="font-size: 15px">.us</span>&nbsp;
                    <span class="text-white badge badge-info fw-bold" style="font-size: 15px">500.000 VND</span>
                </button>
            </div>
        </div>
    </div>

    <div class="row text-center my-5">
        <div class="col-md-4">
            <div class="card shadow-sm py-4 border-0 rounded">
                <div class="card-body">
                    <i class="bi bi-headset fs-1 text-primary"></i>
                    <h3 class="fw-bold mt-3">Hỗ Trợ 24/7</h3>
                    <p class="text-muted">Đội ngũ của chúng tôi luôn sẵn sàng hỗ trợ bạn mọi lúc.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm py-4 border-0 rounded">
                <div class="card-body">
                    <i class="bi bi-gear fs-1 text-primary"></i>
                    <h3 class="fw-bold mt-3">Quản Lý Dễ Dàng</h3>
                    <p class="text-muted">Quản lý tên miền với giao diện đơn giản và trực quan.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mx-auto" data-form="search-domain" data-url="">
            <div class="card shadow-sm py-4 border-0 rounded">
                <div class="card-body">
                    <i class="bi bi-patch-check fs-1 text-primary"></i>
                    <h3 class="fw-bold mt-3">Cam Kết Chất Lượng</h3>
                    <p class="text-muted">Chúng tôi đảm bảo tên miền của bạn luôn hoạt động ổn định.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Domain Name Tips Section -->
    <div class="row my-5">
        <div class="col-md-6">
            <h4 class="text-primary fw-bold">Cách Chọn Tên Miền Phù Hợp</h4>
            <ul class="list-unstyled">
                <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Chọn tên dễ nhớ, dễ đọc.</li>
                <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Chọn tên phù hợp với thương hiệu.</li>
                <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Giữ cho tên miền ngắn gọn.</li>
                <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Chỉ bao gồm chữ cái và số.</li>
            </ul>
        </div>
        <div class="col-md-6">
            <img src="<?php echo home_url(); ?>/wp-content/uploads/2024/10/choose_domain.png" alt="Image" class="img-fluid rounded shadow-lg">
            
        </div>
    </div>

    <!-- Website Building Form Section -->
    <div class="row my-5 align-items-center">
        <div class="col-md-6">
            <img src="<?php echo home_url(); ?>/wp-content/uploads/2024/10/buid_web.jpg" alt="Image" class="img-fluid rounded shadow-lg">
            
        </div>
        <div class="col-md-6">
            <h4 class="text-primary fw-bold">Bạn Cần Xây Dựng Website?</h4>
            <p class="text-muted">Đội ngũ thiết kế sẽ giúp bạn xây dựng website hiệu quả và tiết kiệm chi phí.</p>
            <form class="shadow-sm p-4 bg-light rounded">
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Họ tên" />
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="SĐT" />
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email" />
                </div>
                <button type="submit" class="btn btn-warning w-100">Gửi Thông Tin</button>
            </form>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="row my-5">
        <div class="col-md-12">
            <h4 class="text-primary fw-bold">Câu Hỏi Thường Gặp</h4>
            <ul class="list-group">
                <li class="list-group-item">Tên miền do ai quản lý?</li>
                <li class="list-group-item">Ai có thể đăng ký tên miền?</li>
                <li class="list-group-item">Thông tin tên miền của tôi sẽ được công khai?</li>
                <li class="list-group-item">Tôi có thể chia sẻ tên miền khác sau khi đã đăng ký?</li>
                <li class="list-group-item">Phải làm gì khi tên miền đã định đăng ký đã có người đăng ký trước?</li>
            </ul>
        </div>
    </div>
</div>
{{-- @endsection --}}
