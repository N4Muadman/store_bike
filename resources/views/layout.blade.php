<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="ThemesLay">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="50x50" href="/assets/images/favicon.png">

    <!-- main CSS -->
    <link href="/assets/css/main.css" rel="stylesheet">
    <title>@yield('title')</title>
    @vite(['resource/css/app.css', 'resource/js/app.js'])

</head>


<body>
    <div id="notification"></div>
    @if (session()->has('success'))
        <div class="alert alert-success fade show" role="alert">
            <i class="bi bi-check-circle-fill fs-2 me-3"></i>
            <div>
                <p class="title">Thành công</p>
                <p class="notification">{{ session('success') }}</p>
            </div>
            <button type="button" class="btn-close ms-5 fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-error fade show" role="alert">
            <i class="bi bi-check-circle-fill fs-2 me-3"></i>
            <div>
                <p class="title">Thất bại</p>
                <p class="notification">{{ session('error') }}</p>
            </div>
            <button type="button" class="btn-close ms-5 fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="page-loader">
        <div class="loader">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>
    <!-- page wrapper section -->
    <div id="wrapper"></div>
    <!-- Header Part -->
    <div class="position-relative info-top">
        <!-- menu nav Part -->
        <header class="center-nav bg-light border-bottom py-3 py-md-0">
            <div class="container">
                <!-- mega menu -navigation -->
                <nav
                    class="js-mega-menu navbar navbar-expand-md menu-navbar py-0 hs-menu-initialized hs-menu-horizontal">
                    <a class="navbar-brand p-0" href="{{ route('home') }}" aria-label="Front">
                        <img src="/assets/images/logo.jpg" width="100px" style="border-radius: 50%" class="img-fluid"
                            alt="Brand Logo" title="Brand Logo">
                    </a>
                    <!-- Responsive Toggle Button -->
                    <button type="button" class="navbar-toggler btn u-hamburger" aria-label="Toggle navigation"
                        aria-expanded="false" aria-controls="navBar" data-bs-toggle="collapse" data-bs-target="#navBar">
                        <span id="hamburgerTrigger" class="box">
                            <span class="inner"></span>
                        </span>
                    </button>
                    <!-- End Responsive Toggle Button -->

                    <!-- top action button -->
                    <div class="d-flex top ms-auto me-auto mt-4 mt-sm-0 position-relative order-lg-3">

                        <form action="{{ route('product.index') }}" method="get">
                            @foreach (request()->except('search') as $key => $value)
                                @if (is_array($value))
                                    @foreach ($value as $item)
                                        <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                                    @endforeach
                                @else
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endif
                            @endforeach
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"
                                        style="border-top-right-radius: 0; border-bottom-right-radius: 0; "><i
                                            class="bi bi-search" title="Search"></i></div>
                                </div>
                                <input type="search" name="search" class="form-control"
                                    placeholder="Tìm kiếm sản phẩm.." value="{{ request('search') }}" id="">
                            </div>
                        </form>

                        <div class="cart-btn ms-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                            aria-controls="offcanvasRight">
                            <div class="notify-btn">
                                <i class="bi bi-bag" title="Giỏ hàng"></i>
                                <span class="tag" id="count-cart">0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div id="navBar" class="collapse navbar-collapse menu-navbar-collapse justify-content-center">
                        <ul class="navbar-nav menu-navbar-nav">
                            <!-- Shop -->

                            <li class="nav-item last">
                                <a class="nav-link menu-nav-link" href="{{ route('home') }}">
                                    Trang chủ
                                </a>
                            </li>

                            <li class="nav-item last">
                                <a class="nav-link menu-nav-link" href="{{ route('product.index') }}">
                                    Sản phẩm
                                </a>
                            </li>


                            <li class="nav-item last">
                                <a class="nav-link menu-nav-link" href="{{ route('blogs') }}">
                                    Tin tức
                                </a>
                            </li>

                            <!-- Button -->
                            <li class="nav-item last">
                                <a class="nav-link menu-nav-link" href="{{ route('contact') }}">
                                    Liên hệ
                                </a>
                            </li>
                            <!-- End Button -->
                        </ul>
                    </div>
                    <!-- End Navigation -->

                </nav>
                <!-- End mega menu -navigation -->
            </div>
        </header>
    </div>

    @yield('content')
    <!-- Footer Part -->
    <footer class="footer pt-5 pt-lg-0 animate__animated wow animate__backInUp">
        <div class="container">
            <div class="row animate__animated wow animate__backInUp">
                <div class="col-12 col-md-12 col-lg-3 position-relative">
                    <h3 class="fs-2 fw-bold mb-3 mt-4 mt-md-4 mt-lg-5">Về Xe Nhật</h3>
                    <div class="d-flex">
                        <p class="theme-text-accent-one">
                            Xe Nhật - Chuyên xe đạp nhật bãi là điểm đến lý tưởng cho những người yêu xe đạp. Chúng tôi
                            cung cấp
                            đa dạng các dòng xe, phụ kiện chính hãng và luôn sẵn sàng hỗ trợ bạn trên mọi nẻo đường.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-5 position-relative">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <h3 class="fs-2 fw-bold mb-4 mt-4 mt-lg-5">Thông Tin</h3>
                                    <ul class="footer-link">
                                        
                                        <li><i class="bi bi-chevron-double-right"></i><a href="{{route('contact')}}">Liên Hệ</a></li>
                                        <li><i class="bi bi-chevron-double-right"></i><a href="{{route('blogs')}}">Tin tức</a></li>

                                    </ul>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h3 class="fs-2 fw-bold mb-4 mt-4 mt-lg-5">Mua Sắm</h3>
                                    <ul class="footer-link">
                                        <li><i class="bi bi-chevron-double-right"></i><a
                                                href="{{ route('product.index', ['sort' => 'purchases']) }}">Sản
                                                Phẩm Bán Chạy</a></li>
                                        <li><i class="bi bi-chevron-double-right"></i><a
                                                href="{{ route('product.index', ['sort' => 'discount']) }}">Sản
                                                Phẩm Giảm Giá</a></li>
                                        <li><i class="bi bi-chevron-double-right"></i><a
                                                href="{{ route('product.index', ['sort' => 'newest']) }}">Sản
                                                Phẩm Mới Về</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 custom position-relative">
                    <h3 class="fs-2 fw-bold mb-3 mt-4 mt-lg-5">Ưu Đãi Đặc Biệt</h3>
                    <p class="mt-0 mt-lg-4">
                        Hãy theo dõi Xe Nhật - Chuyên xe đạp nhật bãi để không bị bỏ lỡ những chương trình khuyến mãi
                        hấp dẫn nhất !
                    </p>
                    {{-- <form class="form-subcriber d-flex flex-column">
                        <input type="email" placeholder="Địa chỉ email của bạn">
                        <div class="m-0">
                            <button class="btn custom-btn-primary font-small fw-bold button-effect"
                                type="submit">Đăng Ký</button>
                        </div>
                    </form> --}}
                </div>
            </div>
            <div class="row my-4 animate__animated wow animate__backInUp">
                <div class="position-relative text-center">
                    <img src="/assets/images/logo.jpg" style="border-radius: 50%" width="100px" class="img-fluid"
                        alt="Logo Xe Nhật - Chuyên xe đạp nhật bãi">
                </div>
                <div class="d-flex flex-row flex-wrap justify-content-center align-items-center position-relative">
                    <ul class="inline-link">
                        <li>
                            <p class="text-center mb-0 theme-text-accent-one d-inline">Liên Kết Phổ Biến</p>
                        </li>
                        <li><a href="{{ route('product.index', ['category' => ['Xe Đạp Địa Hình']]) }}">Xe Đạp Địa
                                Hình</a></li>
                        <li><a href="{{ route('product.index', ['category' => ['Xe Đạp Đường Phố']]) }}">Xe Đạp Đường
                                Phố</a></li>
                        <li><a href="{{ route('product.index', ['category' => ['Xe Đạp Trẻ Em']]) }}">Xe Đạp Trẻ
                                Em</a></li>
                        <li><a href="{{ route('product.index', ['category' => ['Xe Đạp Điện']]) }}">Xe Đạp Điện</a>
                        </li>
                        <li><a href="{{ route('product.index', ['category' => ['Phụ Kiện Xe Đạp']]) }}">Phụ Kiện Xe
                                Đạp</a></li>
                        <li><a href="{{ route('blogs') }}">Tin tức</a></li>
                        {{-- <li><a href="/tin-tuc/thuong-hieu-noi-tieng">Thương Hiệu Nổi Tiếng</a></li> --}}
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="d-flex align-items-center mt-4 mt-lg-5">
                        <h3 class="fs-4 fw-bold mb-0">Mạng Xã Hội</h3>
                        <div class="d-flex social ms-5">
                            <a href="https://www.facebook.com/anhthuat.van" class="fs-4 pe-2"><i
                                    class="bi bi-facebook"></i></a>
                            <a href="https://zalo.me/0976717688" class="fs-4 px-2"></a>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6">
                    {{-- <div class="d-flex align-items-center mt-4 mt-lg-5">
                        <h3 class="fs-4 fw-bold mb-0">Hình Thức Thanh Toán</h3>
                        <div class="ms-5">
                            <img src="/assets/images/icons/visa.png" class="img-fluid" alt="Visa">
                            <img src="/assets/images/icons/mastercard.png" class="img-fluid" alt="Mastercard">
                            <img src="/assets/images/icons/paypal.png" class="img-fluid" alt="PayPal">
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="footer-bottom position-relative animate__animated wow animate__backInUp">
            <div class="container">
                <div class="row py-3">
                    <div class="col-12">
                        <ul class="bottom-link d-flex flex-row flex-wrap justify-content-center align-items-center">
                            <li><a href="/">Trang Chủ</a></li>
                            <li><a href="{{ route('product.index') }}">Sản phẩm</a></li>
                            <li><a href="{{ route('blogs') }}">Tin tức</a></li>
                            <li><a href="{{ route('contact') }}">Liên Hệ</a></li>
                            {{-- <li><a href="/huong-dan-mua-hang">Hướng Dẫn Mua Hàng</a></li> --}}
                        </ul>
                    </div>
                    <div class="col-12">
                        <p class="mb-0 mt-3 font-small text-center">&copy; 2025 Bản quyền Xe Nhật - Chuyên xe đạp nhật
                            bãi, Mọi
                            quyền được bảo lưu. Với Yêu Thương <i class="bi bi-heart-fill"></i> bởi
                            <a href="https://www.templatemonster.com/authors/themeslay/">Idai.vn</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- back to top -->
    <a href="#wrapper" data-type="section-switch" class="scrollup theme-border-radius">
        <i class="bi bi-arrow-up" title="Back to Top Icon"></i></a>
    <!-- Search model Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="bi bi-x-lg"></i></div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
                <button class="btn custom-btn-primary button-effect min-w-auto"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </div>
    <!-- cart checkout section -->
    <div class="offcanvas offcanvas-end cart-menu d-flex flex-column h-100" tabindex="-1" id="offcanvasRight"
        aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header p-4">
            <div class="text-start">
                <h5 id="offcanvasRightLabel" class="mb-0 fs-2 theme-text-primary fw-bold">Giỏ hàng</h5>
            </div>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-4 pt-0 d-flex">
            <div class="d-flex flex-column overflow-y-hidden flex-grow-1 flex-shrink-1">
                <!-- cart content -->
                <div class="mb-2 border-top overflow-auto d-flex flex-column flex-grow-1 flex-shrink-1">
                    <ul class="list-group list-group-flush" id="cart-list">

                    </ul>
                </div>
                <!-- cart footer section -->
                <div class="bg-light">
                    <!-- order total -->
                    <div class="d-flex mb-3">
                        <h5 class="mb-0 me-auto">Tổng cộng</h5>
                        <h5 class="mb-0" id="total-cart"></h5>
                    </div>
                    <!-- btn -->
                    <div class="d-flex flex-column custom-button">
                        <p class="mb-2">Phí vận chuyển và mã giảm giá được tính khi thanh toán.</p>
                        <a href="{{ route('checkout') }}"
                            class="d-flex align-items-center custom-btn-primary button-effect w-100 text-uppercase">Thanh
                            toán</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- wishlist notify -->
    <div class="wish-notify"></div>
    <!-- compare notify -->
    <div class="compare-notify"></div>
    <!-- add to cart notify -->
    <div class="cart-notify">
        <a href="javascript:void(0)" class="ms-cart-toggle">
            <i class="bi bi-basket3 fs-1"></i><span>3</span></a>
    </div>
    <!-- quick view modal -->
    <div class="modal fade" id="quickViewModal" tabindex="-1">

    </div>
    <div class="modal fade custom-contact-modal" id="contactModal" tabindex="-1"
        aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">LIÊN HỆ VỚI CHÚNG TÔI</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Form Liên Hệ -->
                            <div class="col-md-6">
                                <form class="custom-contact-form" action="{{ route('contacts.store') }}"
                                    method="POST">
                                    @csrf
                                    <h4 class="mb-4 text-center" style="color: #e40202;">Gửi Thông Tin</h4>
                                    <input type="hidden" name="product_id" value=""
                                        id="product_id_form_contact">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="contact_name"
                                            placeholder="Họ và tên" required name="name">
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" id="contact_email"
                                            placeholder="Email" required name="email">
                                    </div>
                                    <div class="mb-3">
                                        <input type="tel" class="form-control" id="contact_phone"
                                            placeholder="Số điện thoại" name="phone">
                                    </div>

                                    <div class="mb-3">
                                        <textarea class="form-control" name="message" id="contact_message" rows="4" placeholder="Nội dung tin nhắn"
                                            required></textarea>
                                    </div>
                                    <button type="submit" class="btn custom-btn-submit w-100">GỬI THÔNG TIN</button>
                                </form>
                            </div>

                            <!-- Thông Tin Liên Hệ -->
                            <div class="col-md-6">
                                <div class="custom-contact-info">
                                    <h4 class="text-center">Thông Tin Liên Hệ</h4>
                                    <p><i class="fas fa-map-marker-alt"></i> Chợ gỗ, Thăng Bình, Nông Cống, Thanh Hóa
                                    </p>

                                    <p><i class="fas fa-mobile-alt"></i> 0976.717.688</p>
                                    <p><i class="fas fa-envelope"></i> ai@idai.vn</p>

                                    <div class="custom-contact-divider"></div>

                                    <h5 class="text-center mt-4" style="color: #e40202;">Kết nối với chúng tôi</h5>
                                    <div class="custom-social-links">
                                        <a href="https://www.facebook.com/anhthuat.van">
                                            <i class="bi bi-facebook fs-3 ms-2" style="color: blue"></i></a>
                                        <a target="_blank" class="icon-zalo" href="https://zalo.me/0976717688">
                                            <img alt="Zalo" src="/assets/images/about/zalo.png" width="16px">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="button-contact-vr" class="">
        <div id="gom-all-in-one">
            <div id="zalo-vr" class="button-contact">
                <div class="phone-vr">
                    <div class="phone-vr-circle-fill"></div>
                    <div class="phone-vr-img-circle">
                        <a target="_blank" href="https://zalo.me/0976717688">
                            <img alt="Zalo" src="/assets/images/about/zalo.png">
                        </a>
                    </div>
                </div>
            </div>
            <div id="phone-vr" class="button-contact">
                <div class="phone-vr">
                    <div class="phone-vr-circle-fill"></div>
                    <div class="phone-vr-img-circle">
                        <a href="tel:0976717688">
                            <img alt="Phone" src="/assets/images/about/phone.png">
                        </a>
                    </div>
                </div>
            </div>
            <div class="phone-bar phone-bar-n">
                <a href="tel:0976717688">
                    <span class="text-phone">0976.717.688</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="../../../../../../cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/slick.min.js"></script>
    <script src="/assets/js/slick-animation.min.js"></script>
    <script src="/assets/js/wow.min.js"></script>
    <script src="/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/assets/js/hs.megamenu.js"></script>
    <script src="/assets/js/main.js"></script>
    <script>
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.classList.remove('show');
                alert.classList.add('d-none');
            });
        }, 2500);

        const baseUrl = '{{ ENV('APP_URL') }}';
        async function getMyCart() {
            try {
                const response = await fetch(`{{ route('getCarts') }}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                });

                if (!response.ok) {
                    throw new Exception('Error fetching');
                }
                const data = await response.json();
                const carts = data.carts;
                document.getElementById('count-cart').innerText = carts.length;
                let listCart = '';
                let total = 0;

                carts.forEach(function(cart, index) {
                    total += cart.sale_price > 0 ? cart.sale_price * cart.quantity : cart.price * cart.quantity;

                    listCart += `
                                    <li class="list-group-item py-3 ps-0">
                                        <div class="row align-items-center">
                                            <div class="col-3 col-md-2 col-lg-3">
                                                <a href="{{ route('product.detail', ':id') }}">
                                                    <img src="${cart.image}" alt="Parts"
                                                    class="img-fluid">
                                                </a>
                                            </div>
                                            <div class="col-7 col-md-8 col-lg-7">
                                                <a href="{{ route('product.detail', ':id') }}" class="text-inherit">
                                                    <p class="mb-0 font-small fw-bold">${cart.product_name}</p>
                                                </a>
                                                <span class=""><small class="text-muted">${cart.quantity} X</small><span
                                                        class="ms-2">${new Intl.NumberFormat().format(cart.sale_price > 0 ? cart.sale_price : cart.price)} đ</span></span>
                                            </div>
                                            <!-- input group -->
                                            <div class="col-2 col-md-2 col-lg-2 text-lg-end text-start text-md-end col-md-2">
                                                <div class="mt-2 lh-1"> <a href="javascript:void(0)" data-index="${index}"
                                                        class="text-decoration-none text-inherit delete-cart">
                                                        <span class="me-1 align-middle"><i class="bi bi-x"></i></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>`.replace(':id', cart.product_id).replace(':id', cart.product_id);
                });

                if (carts.length < 1) {
                    listCart =
                        `<li class="list-group-item py-3 ps-0 w-100"> <p class="text-center">Không có sản phẩm nào trong giỏ hàng</p> </li>`
                }

                document.getElementById('cart-list').innerHTML = listCart;
                document.getElementById('total-cart').innerText = carts.length > 0 ? new Intl.NumberFormat().format(
                    total) + ' đ' : '0 đ';
                const cartlistindexId = document.getElementById('list-carts-index');
                if (cartlistindexId) {
                    let cartlistindex = '';
                    carts.forEach(function(cart, index) {
                        cartlistindex += `
                                <div class="list-group-item p-3 mb-3 border-bottom">
                                    <!-- row -->
                                    <div class="row align-items-center">
                                        <div class="col-6 col-md-2">
                                            <img src="${cart.image}" alt="Parts"
                                                class="img-fluid">
                                        </div>
                                        <div class="col-6 col-md-6 col-lg-5">
                                            <a href="{{ route('product.detail', ':id') }}" class="text-reset">
                                                <p class="mb-0 fw-bold">${cart.product_name}</p>
                                            </a>
                                        </div>
                                        <div class="col-6 col-md-3 col-lg-3 d-flex justify-content-between align-items-center pt-3 pb-3">
                                            <div class="px-0 d-flex flex-column align-items-center justify-content-center">
                                                <div class="input-group input-spinner d-inline-flex justify-content-center">
                                                    <span class="button-minus btn btn-sm dec" data-index="${index}">-</span>
                                                    <input type="text" value="${cart.quantity}"
                                                        class="quantity-field form-control-sm form-input">
                                                    <span class="button-plus btn btn-sm inc" data-index="${index}">+</span>
                                                </div>
                                                <div class="mt-2 small lh-1"> <a href="javascript:void(0)"
                                                        class="text-decoration-none text-inherit delete-cart" data-index="${index}">
                                                        <span class="me-1 align-middle"><i class="bi bi-trash"></i></span>
                                                        <span class="text-muted font-extra-small">Remove</span></a>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <span class="fw-bold">${ cart.sale_price > 0 ? new Intl.NumberFormat().format(cart.sale_price) :  new Intl.NumberFormat().format(cart.price) } đ</span>
                                                <div class="text-decoration-line-through text-muted">${ cart.sale_price > 0 ? new Intl.NumberFormat().format(cart.price) + ' đ' :  '' } </div>
                                                <span class="fw-bold">Tiết kiệm : ${new Intl.NumberFormat().format(cart.sale_price > 0 ? cart.price - cart.sale_price : 0)} đ</span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-6 col-md-2 text-end">
                                            <span class="fw-bold">${new Intl.NumberFormat().format(cart.sale_price > 0 ? cart.sale_price * cart.quantity : cart.price * cart.quantity)} đ</span>
                                        </div>
                                    </div>
                                </div>
                            `.replace(':id', cart.product_id);
                    });
                    document.getElementById('subtotal').innerText = carts.length > 0 ? new Intl.NumberFormat().format(
                        total) + ' đ' : '0đ';
                    document.getElementById('total').innerText = carts.length > 0 ? new Intl.NumberFormat().format(
                        total) + ' đ' : '0đ';
                    cartlistindexId.innerHTML = cartlistindex;
                }

            } catch (e) {
                console.log('error: ', e);
            }
        }

        function addToCart() {
            document.querySelectorAll('.form-add-to-cart').forEach(function(element) {
                element.addEventListener('submit', async function(event) {
                    event.preventDefault();
                    const formData = new FormData(element);

                    const productId = formData.get('product_id');
                    const quantity = formData.get('quantity');
                    console.log('add to cart');

                    try {
                        const response = await fetch(`{{ route('addToCart') }}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                product_id: productId,
                                quantity: quantity
                            })
                        });

                        const data = await response.json();

                        if (!response.ok) {
                            document.getElementById('notification').innerHTML = `<div class="alert alert-danger fade show" role="alert" id="auto-close-alert">
                            <i class="bi bi-exclamation-circle fs-2 me-3" aria-hidden="true"></i>
                            <div>
                                <p class="title">Thất bại</p>
                                <p class="notification">${data.message}</p>
                            </div>
                            <button type="button" class="btn-close ms-5 fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                            return;
                        }

                        document.getElementById('notification').innerHTML = `<div class="alert alert-success fade show" role="alert" id="auto-close-alert">
                        <i class="bi bi-check-circle-fill fs-2 me-3"></i>
                        <div>
                            <p class="title">Thành công</p>
                            <p class="notification">${data.message}</p>
                        </div>
                        <button type="button" class="btn-close ms-5 fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                        setTimeout(function() {
                            const alert = document.getElementById('auto-close-alert');
                            if (alert) {
                                alert.remove();
                            }
                        }, 3000);

                        getMyCart();

                    } catch (e) {
                        console.log('Error: ', e);
                    }
                });
            });
        }
        document.getElementById('cart-list').addEventListener('click', function(event) {
            const deleteButton = event.target.closest('.delete-cart');
            if (deleteButton) {
                const index = deleteButton.getAttribute('data-index');
                deleteCart(index);
            }
        });
        const listCartIndex = document.getElementById('list-carts-index');
        if (listCartIndex) {
            listCartIndex.addEventListener('click', function(event) {
                const deleteButton = event.target.closest('.delete-cart');
                if (deleteButton) {
                    const index = deleteButton.getAttribute('data-index');
                    deleteCart(index);
                }
                const increaseButton = event.target.closest('.inc');
                if (increaseButton) {
                    const index = increaseButton.getAttribute('data-index');
                    increaseCart(index);
                }
                const decreaseButton = event.target.closest('.dec');
                if (decreaseButton) {
                    const index = decreaseButton.getAttribute('data-index');
                    decreaseCart(index);
                }
            });
        }
        async function deleteCart(index) {
            try {
                const url = `{{ route('deleteCart', ':index') }}`.replace(':index', index);
                const response = await fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await response.json();
                if (response.ok) {
                    document.getElementById('notification').innerHTML = `<div class="alert alert-success fade show" role="alert" id="auto-close-alert">
                            <i class="bi bi-check-circle-fill fs-2 me-3"></i>
                            <div>
                                <p class="title">Thành công</p>
                                <p class="notification">${data.message}</p>
                            </div>
                            <button type="button" class="btn-close ms-5 fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                    setTimeout(function() {
                        const alert = document.getElementById('auto-close-alert');
                        if (alert) {
                            alert.remove();
                        }
                    }, 3000);
                    getMyCart();
                } else {
                    document.getElementById('notification').innerHTML = `<div class="alert alert-danger fade show" role="alert" id="auto-close-alert">
                            <i class="bi bi-exclamation-circle fs-2 me-3" aria-hidden="true"></i>
                            <div>
                                <p class="title">Thất bại</p>
                                <p class="notification">${data.message}</p>
                            </div>
                            <button type="button" class="btn-close ms-5 fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                    setTimeout(function() {
                        const alert = document.getElementById('auto-close-alert');
                        if (alert) {
                            alert.remove();
                        }
                    }, 3000);
                }
            } catch (e) {
                console.log('Error: ', e);
            }
        }
        async function decreaseCart(index) {
            try {
                const url = `{{ route('decreaseCart', ':index') }})`.replace(':index', index);
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await response.json();

                if (!response.ok) {
                    document.getElementById('notification').innerHTML = `<div class="alert alert-danger fade show" role="alert" id="auto-close-alert">
                            <i class="bi bi-exclamation-circle fs-2 me-3" aria-hidden="true"></i>
                            <div>
                                <p class="title">Thất bại</p>
                                <p class="notification">${data.message}</p>
                            </div>
                            <button type="button" class="btn-close ms-5 fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                    setTimeout(function() {
                        const alert = document.getElementById('auto-close-alert');
                        if (alert) {
                            alert.remove();
                        }
                    }, 3000);
                }

                getMyCart();

            } catch (e) {
                console.log('Error: ', e);

            }
        }

        async function increaseCart(index) {
            try {
                const url = `{{ route('increaseCart', ':index') }})`.replace(':index', index);
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await response.json();
                if (!response.ok) {
                    document.getElementById('notification').innerHTML = `<div class="alert alert-danger fade show" role="alert" id="auto-close-alert">
                            <i class="bi bi-exclamation-circle fs-2 me-3" aria-hidden="true"></i>
                            <div>
                                <p class="title">Thất bại</p>
                                <p class="notification">${data.message}</p>
                            </div>
                            <button type="button" class="btn-close ms-5 fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                    setTimeout(function() {
                        const alert = document.getElementById('auto-close-alert');
                        if (alert) {
                            alert.remove();
                        }
                    }, 3000);
                }

                getMyCart();

            } catch (e) {
                console.log('Error: ', e);

            }
        }

        function setProductIdFormContact() {
            document.querySelectorAll('.btn-contact').forEach((element) => {
                element.addEventListener('click', () => {
                    document.getElementById('product_id_form_contact').value = element.dataset.id;
                });
            });
        }

        document.querySelectorAll('.quick-view').forEach(function(element) {
            element.addEventListener('click', function() {
                productId = this.dataset.id;

                if (productId) {
                    let url = `{{ route('quick-view', ':productId') }}`.replace(':productId', productId);
                    fetch(url)
                        .then(response => {
                            if (response.ok) {
                                return response.text();
                            } else {
                                throw new Error('Network response was not ok.');
                            }
                        })
                        .then(html => {
                            document.getElementById('quickViewModal').innerHTML = html;
                            new bootstrap.Modal(document.getElementById('quickViewModal')).show();
                            addToCart();
                            setProductIdFormContact();
                        })
                        .catch(error => {
                            console.error('There was a problem with the fetch operation:', error);
                        });
                }
            });
        });
        addToCart();
        getMyCart();
        setProductIdFormContact();
    </script>

    @yield('scripts')
</body>


<!-- Mirrored from themes.pixelstrap.com/fastkart/front-end/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 31 Mar 2025 01:30:42 GMT -->

</html>
