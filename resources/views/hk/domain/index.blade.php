<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .spinner {
        border: 3px solid #f3f3f3;
        border-top: 3px solid #3498db;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        animation: spin 1s linear infinite;
    }

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

    /* .btn-success {
        padding: 0.75rem 0;
        font-size: 1.2rem;
        font-weight: bold;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    } */

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

        <!-- Modal -->
        <div class="modal" id="register-modal">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <!-- Header -->
                    <div class="modal-header">
                        <h4 data-control="modal-heading" class="modal-title">Modal Heading</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
        
                    <!-- body -->
                    <div class="modal-body" data-control="modal-body">
                        
                    </div>
        
                    <!-- footer -->
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
                            <span data-control="available-domain-name" style="font-weight: bold">#N/A</span>
                        </div>
                        
                        <div class="col-md-3">
                            <span>1 năm</span>
                        </div>
                
                        <div class="col-md-3">
                            <span data-control="available-domain-price"></span>
                        </div>
                
                        <div class="col-md-3">
                            <button data-action="by-available-domain" class="btn btn-success">Chọn mua</button>
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

                    this.events();
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

                handleValid(domain) {
                    this.setAvailableDomain(domain.name);
                    this.setAvailableDomainPrice(this.formatNumberToVnd(domain.price))
                    this.hideInvalidForm();
                    this.showValidForm();
                }

                handleInvalid() {
                    this.setAvailableDomain(null);
                    this.hideValidForm();
                    this.showInValidForm();
                }

                formatNumberToVnd(number, decimals = 0) {
                    if (Number.isInteger(number)) {
                        decimals = 0;
                    }

                    return number.toLocaleString('en-US', {
                        minimumFractionDigits: decimals,
                        maximumFractionDigits: decimals
                    });
                }

                formatPrice(priceString) {
                    const priceNumber = priceString.replace(/\D/g, ''); 
                    const formattedPrice = Number(priceNumber).toLocaleString('en-US'); 

                    return formattedPrice;
                }

                getAvailabledDomainSpan() {
                    return this.container.find('[data-control="available-domain-name"]');
                }

                getAvailabledDomainPriceSpan() {
                    return this.container.find('[data-control="available-domain-price"]');
                }

                getAvailableDomainName() {
                    return this.getAvailabledDomainSpan().html();
                }

                getAvailableDomainPrice() {
                    return this.container.find('[data-control="available-domain-price"]').html();
                }

                getBuyBtn() {
                    return this.container.find('[data-action="by-available-domain"]');
                }

                setAvailableDomain(name) {
                    this.getAvailabledDomainSpan().html(name);
                }

                setAvailableDomainPrice(price) {
                    this.getAvailabledDomainPriceSpan().html(price + " VNĐ");
                }

                setupModalBody() {
                    const name = this.getAvailableDomainName();
                    const price = this.getAvailableDomainPrice();
                    const formatedPrice = this.formatPrice(price);

                    return `
                        <form data-form="create-suggest" class="rounded shadow-sm overflow-hidden">
                            @csrf
                            <div class="d-flex justify-content-center align-items-center container">
                                <div class="px-3">
                                    <h2 class="m-0 mb-2 text-bold">${name}</h2><span class="mobile-text">Sở hữu tên miền <u><b class="text-danger">${name}</b></u> với <b class="text-danger">${formatedPrice} VNĐ</b>/Năm đầu tiên</span>
                                </div>
                            </div>

                            <input type="hidden" value="${name}" name="name">
                            <input type="hidden" value="${price}" name="price">

                            <div class="card-body p-0">
                                <div class="row gy-3 gy-md-4 gy-lg-0">
                                    <div class="col-12 col-md-12">
                                        <div class="row align-items-lg-center h-100">
                                            <div class="col-12">
                                                <form action="#!">
                                                    <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
                                                        <div class="col-12 col-md-12 mt-3">
                                                            <div class="row">
                                                                <div class="col-md-2 d-flex align-items-center p-0 justify-content-left">
                                                                    <label for="email" class="form-label mb-0">
                                                                        Tên <span class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                            
                                                                <div class="col-md-10 p-0">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                                                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 1a5 5 0 0 0-4.546 2.914A5.982 5.982 0 0 0 8 16a5.982 5.982 0 0 0 4.546-2.086A5 5 0 0 0 8 9zm0 7a4.978 4.978 0 0 1-3.598-1.6C5.48 13.66 6.615 13 8 13s2.52.66 3.598 1.4A4.978 4.978 0 0 1 8 16z"/>
                                                                            </svg>
                                                                        </span>
                                                                        <input type="text" class="form-control" id="name" name="name" value="" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-md-12 mt-3">
                                                            <div class="row">
                                                                <div class="col-md-2 d-flex align-items-center p-0 justify-content-left">
                                                                    <label for="email" class="form-label mb-0">
                                                                        Email <span class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                            
                                                                <div class="col-md-10 p-0">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                                                            </svg>
                                                                        </span>
                                                                        <input type="email" class="form-control" id="email" name="email" value="" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-md-12 mt-3">
                                                            <div class="row">
                                                                <div class="col-md-2 d-flex align-items-center p-0 justify-content-left">
                                                                    <label for="phone" class="form-label mb-0">
                                                                        Số điện thoại <span class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                            
                                                                <div class="col-md-10 p-0">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                                                                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                                                            </svg>
                                                                        </span>
                                                                        <input type="number" class="form-control" id="phone" name="phone" value="" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-5">
                                                            <div class="d-grid">
                                                                <button data-action="save" class="btn btn-primary btn-lg" type="submit">Hoàn Tất Đăng Ký</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    `;
                }

                initForm() {
                    new CreateForm({
                        container: $('[data-form="create-suggest"]')
                    })
                }

                events() {
                    this.getBuyBtn().on('click', e => {
                        e.preventDefault();

                        registerModal.setHeading("Thanh toán tên miền");
                        registerModal.setBody(this.setupModalBody());
                        registerModal.show();

                        this.initForm();
                    })
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
                            this.validationBox.handleValid(res.domain);
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

            var CreateForm = class {
                constructor(options) {
                    this.container = options.container;
                    this.events();
                }

                getSaveBtn() {
                    return this.container.find('[data-action="save"]')
                }

                getUrl() {
                    return "{!! esc_url(get_site_url()) . '?page=hk&path=/hk/save-order' !!}";
                }

                events() {
                    this.getSaveBtn().on('click', e => {
                        e.preventDefault();

                        const data = $(this.container).serialize();

                        $.ajax({
                            url: this.getUrl(),
                            method: 'POST',
                            data: data
                        }).done(res => {
                            HKTool.alert({
                                icon: 'success',
                                message: "Tạo đơn thành công!",
                                ok: () => {
                                    registerModal.hide();
                                }
                            })
                        }).fail(res => {
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
                        <form data-form="create-suggest" class="rounded shadow-sm overflow-hidden">
                            @csrf
                            <div class="d-flex justify-content-center align-items-center container">
                                <div class="px-3">
                                    <h2 class="m-0 mb-2 text-bold">${name}</h2><span class="mobile-text">Sở hữu tên miền <u><b class="text-danger">${name}</b></u> với <b class="text-danger">${formatedPrice} VNĐ</b>/Năm đầu tiên</span>
                                </div>
                            </div>

                            <input type="hidden" value="${name}" name="name">
                            <input type="hidden" value="${price}" name="price">

                            <div class="card-body p-0">
                                <div class="row gy-3 gy-md-4 gy-lg-0">
                                    <div class="col-12 col-md-12">
                                        <div class="row align-items-lg-center h-100">
                                            <div class="col-12">
                                                <form action="#!">
                                                    <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
                                                        <div class="col-12 col-md-12 mt-3">
                                                            <div class="row">
                                                                <div class="col-md-2 d-flex align-items-center p-0 justify-content-left">
                                                                    <label for="email" class="form-label mb-0">
                                                                        Tên <span class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                            
                                                                <div class="col-md-10 p-0">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                                                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 1a5 5 0 0 0-4.546 2.914A5.982 5.982 0 0 0 8 16a5.982 5.982 0 0 0 4.546-2.086A5 5 0 0 0 8 9zm0 7a4.978 4.978 0 0 1-3.598-1.6C5.48 13.66 6.615 13 8 13s2.52.66 3.598 1.4A4.978 4.978 0 0 1 8 16z"/>
                                                                            </svg>
                                                                        </span>
                                                                        <input type="text" class="form-control" id="name" name="name" value="" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-md-12 mt-3">
                                                            <div class="row">
                                                                <div class="col-md-2 d-flex align-items-center p-0 justify-content-left">
                                                                    <label for="email" class="form-label mb-0">
                                                                        Email <span class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                            
                                                                <div class="col-md-10 p-0">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                                                            </svg>
                                                                        </span>
                                                                        <input type="email" class="form-control" id="email" name="email" value="" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-md-12 mt-3">
                                                            <div class="row">
                                                                <div class="col-md-2 d-flex align-items-center p-0 justify-content-left">
                                                                    <label for="phone" class="form-label mb-0">
                                                                        Số điện thoại <span class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                            
                                                                <div class="col-md-10 p-0">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                                                                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                                                            </svg>
                                                                        </span>
                                                                        <input type="number" class="form-control" id="phone" name="phone" value="" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-5">
                                                            <div class="d-grid">
                                                                <button data-action="save" class="btn btn-primary btn-lg" type="submit">Hoàn Tất Đăng Ký</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    `;
                }

                initForm() {
                    new CreateForm({
                        container: $('[data-form="create-suggest"]')
                    })
                }

                events() {
                    this.getBuyBtn().on('click', e => {
                        e.preventDefault();

                        const url = this.getUrl();

                        registerModal.setHeading("Xác nhận");
                        registerModal.setBody(this.setupModalBody());
                        registerModal.show();
                        
                        this.initForm();
                    })
                }
            }
        </script>

        <div class="col-md-12 mt-5">
            <div class="row d-flex justify-content-around">
                @foreach (\App\Services\Domain\Domain::getPrices() as $key => $price)
                    <button class="btn btn-outline-secondary text-dark fw-semibold col-md-2 mx-4 my-2 badge badge-info border-0 py-2">
                        <span class="badge badge-info fw-bold" style="font-size: 15px">{{ $key }}</span>&nbsp;
                        <span class="text-white badge badge-info fw-bold" style="font-size: 15px">{{ \App\Helpers\Functions::formatNumberToVnd($price) }} VND</span>
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row text-center my-5">
        <div class="col-md-4">
            <div class="card shadow-sm py-4 border-0 rounded">
                <div class="card-body">
                    {{-- <i class="bi bi-headset fs-1 text-primary"></i> --}}
                    <h3 class="fw-bold mt-3">Hỗ Trợ 24/7</h3>
                    <p class="text-muted">Đội ngũ của chúng tôi luôn sẵn sàng hỗ trợ bạn mọi lúc.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm py-4 border-0 rounded">
                <div class="card-body">
                    {{-- <i class="bi bi-gear fs-1 text-primary"></i> --}}
                    <h3 class="fw-bold mt-3">Quản Lý Dễ Dàng</h3>
                    <p class="text-muted">Quản lý tên miền với giao diện đơn giản và trực quan.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mx-auto">
            <div class="card shadow-sm py-4 border-0 rounded">
                <div class="card-body">
                    {{-- <i class="bi bi-patch-check fs-1 text-primary"></i> --}}
                    <h3 class="fw-bold mt-3">Cam Kết Chất Lượng</h3>
                    <p class="text-muted">Chúng tôi đảm bảo tên miền của bạn luôn hoạt động ổn định.</p>
                </div>
            </div>
        </div>
    </div>

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