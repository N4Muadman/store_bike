@extends('layout')

@section('title', 'Trang chủ')

@section('content')
    <section class="hero">
        <div class="carouselhero">
            <div class="slider-item set-bg" data-setbg="/assets/images/slider/banner.jpg">
                {{-- <div class="container">
                <div class="row">
                    <div class="col-12 text-start position-relative">
                        <h1 class="display-4 fw-bold text-uppercase mb-4 theme-text-primary animate__animated"
                            data-animation-in="animate__fadeInUp" data-delay-in=".1s">All Range of <br> Cycle
                            Mechine</h1>
                        <p class="fs-5 mb-0 animate__animated" data-animation-in="animate__fadeInUp"
                            data-delay-in=".2s">All
                            Related Products Available</p>
                        <div class="group justify-content-start mt-5 custom-button animate__animated"
                            data-animation-in="animate__fadeInUp" data-delay-in=".3s">
                            <button
                                class="btn custom-btn-primary font-small fw-bold button-effect transition-3d-hover px-4"
                                type="submit">Shop Product</button>
                        </div>
                    </div>
                </div>
            </div> --}}
            </div>
            <!-- repetable item -->
            <div class="slider-item set-bg" data-setbg="/assets/images/slider/slider05.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-start position-relative">
                            <p class="fs-3 mb-0 theme-text-primary text-uppercase animate__animated"
                                data-animation-in="animate__fadeInDown" data-delay-in=".1s">New Gear Offer end Sesion
                                Sale</p>
                            <h1 class="display-1 font-black text-uppercase mb-4 animate__animated"
                                data-animation-in="animate__fadeInDown" data-delay-in=".2s">50% Off</h1>
                            <div class="group mt-5 custom-button justify-content-start animate__animated"
                                data-animation-in="animate__fadeInDown" data-delay-in=".3s">
                                <button class="btn custom-btn-primary fw-bold button-effect transition-3d-hover px-4"
                                    type="submit">Shop
                                    Product</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- repetable item -->
        </div>
    </section>

    <!-- Our Product banner section -->
    <section class="product-banner pt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 mb-3 mb-md-0 animate__animated wow animate__backInUp">
                    <div class="wrap">
                        <div class="box px-2 px-lg-0">
                            <div class="product set-bg" data-setbg="/assets/images/product/product-banner01.png"></div>
                        </div>
                        <div class="content">
                            <h1 class="mb-0 theme-text-primary fw-bold">Chuẩn bị tựu trường</h1>
                            <p class="my-0 fs-6">Giảm giá 50% trong mùa này</p>
                            <div class="custom-button mt-4">
                                <a href="{{ route('product.index') }}"
                                    class="custom-btn-secondary btn-shop font-small px-4 button-effect">
                                    Mua ngay
                                    <i class="bi bi-arrow-right fs-6 ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- repetable -->
                <div class="col-12 col-md-6 mb-3 mb-md-0 animate__animated wow animate__backInUp">
                    <div class="wrap">
                        <div class="box px-2 px-lg-0">
                            <div class="product set-bg" data-setbg="/assets/images/product/product-banner02.png"></div>
                        </div>
                        <div class="content">
                            <h1 class="mb-0 theme-text-primary fw-bold">Giá cả phải chăng</h1>
                            <p class="my-0 fs-6">Chỉ từ 2.000.000 đ</p>
                            <div class="custom-button mt-4">
                                <a href="{{ route('product.index') }}"
                                    class="custom-btn-secondary btn-shop font-small px-4 button-effect">
                                    Mua ngay
                                    <i class="bi bi-arrow-right fs-6 ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- repetable -->
            </div>
        </div>
    </section>
    <!-- top categories section -->
    <section class="topCategories py-5">
        <div class="container">
            <div class="row mt-3">
                <div class="col-12 col-lg-6 animate__animated wow animate__backInUp">
                    <span class="high-text"></span>
                    <h2 class="fs-1 fw-bold text-start theme-text-primary mb-3">Sản phẩm </h2>
                </div>
                <div class="col-12 col-lg-6 animate__animated wow animate__backInUp">
                    <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item mb-2 mb-md-0" role="presentation">
                            <button class="nav-link text-truncate active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">
                                Tất cả sản phẩm
                            </button>
                        </li>
                        <li class="nav-item mb-2 mb-md-0" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">
                                Bán chạy
                            </button>
                        </li>
                        <li class="nav-item mb-2 mb-md-0" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">
                                Giảm giá
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-12 animate__animated wow animate__backInUp">
                    <div class="tab-content my-3" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <!-- tab 1 - first row products -->
                            <div class="row mb-4">
                                @forelse ($products as $product)
                                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                                        <form class="form-add-to-cart" method="POST">
                                            <input type="text" name="product_id" hidden value="{{ $product->id }}">
                                            <div class="card-wrap theme-border-radius px-4 py-4">
                                                <div class="con-img-wrap m-auto product-quick-view">
                                                    <img src="{{ $product->images->first()?->image_path }}"
                                                        class="img-fluid mx-auto d-block" alt="product picture">
                                                    {{-- <div class="deal-badge">
                                                        <span class="badge bg-danger">15% Off</span>
                                                    </div> --}}
                                                    <div class="view">
                                                        <a href="#!" class="view-btn"data-id="{{ $product->id }}">
                                                            <i class="bi bi-eye-fill" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" data-bs-title="Xem nhanh"></i>
                                                        </a>
                                                        @if ($product->price > 0)
                                                            <button type="submit" class="btn view-btn">
                                                                <i class="bi bi-bag" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-title="Thêm vào giỏi hàng"></i>
                                                            </button>
                                                        @else
                                                            <a href="#!" data-bs-toggle="modal"
                                                                data-bs-target="#contactModal" class="view-btn">
                                                                <i class="bi bi-telephone-outbound"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    data-bs-title="Liên hệ"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="con-wrap mt-4">
                                                    <a href="{{ route('product.detail', $product->id) }}"
                                                        class="mb-2 d-block text text-truncate">{{ $product->name }}</a>
                                                    <div class="rating-cover mb-1">
                                                        @php
                                                            $rating =
                                                                $product->reviews->count() > 0
                                                                    ? $product->reviews->sum('rating') /
                                                                        $product->reviews->count()
                                                                    : 5;
                                                        @endphp

                                                        <span class="ml-5">

                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i
                                                                    class="bi {{ $i <= $rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                                            @endfor
                                                        </span>
                                                    </div>

                                                    @if ($product->price > 0)
                                                        <div class="align-self-center mb-2 product-price">
                                                            <span
                                                                class="ms-1 fs-6 fw-bold">{{ $product->has_sale ? number_format($product->sale_price) : number_format($product->price) }}
                                                                đ</span>
                                                            <span
                                                                class="text-decoration-line-through text-muted">{{ $product->has_sale ? number_format($product->price) . ' đ' : '' }}
                                                            </span>
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-between align-items-center flex-column">

                                                            <button type="submit"
                                                                class="btn custom-demo-btn w-100 m-0 ">Thêm vào
                                                                giỏ
                                                                hàng<i class="bi bi-bag ms-2"></i></button>
                                                        </div>
                                                    @else
                                                        <div class="align-self-center mb-2 product-price">
                                                            Giá: <span class="ms-1 fs-6 fw-bold">Liên hệ</span>
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-between align-items-center flex-column">

                                                            <a data-bs-toggle="modal" data-bs-target="#contactModal"
                                                                class="btn custom-demo-btn w-100 m-0 ">
                                                                <i class="bi bi-telephone-outbound me-2"></i>Liên hệ ngay
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @empty
                                    <p class="text-center">Không có sản phẩm nào</p>
                                @endforelse
                            </div>
                            <div class="row">
                                <div class="col-12 text-center mt-4 animate__animated wow animate__backInUp">
                                    <div class="custom-button">
                                        <a href="{{ route('product.index') }}" class="fw-bold link-ef">
                                            Xem thêm sản phẩm<i class="bi bi-arrow-right ps-2"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <!-- tab 2 products -->
                            <div class="row mb-4">
                                @forelse ($bestSellingProducts as $product)
                                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                                        <form class="form-add-to-cart" method="POST">
                                            <input type="text" name="product_id" hidden value="{{ $product->id }}">
                                            <div class="card-wrap theme-border-radius px-4 py-4">
                                                <div class="con-img-wrap m-auto product-quick-view">
                                                    <img src="{{ $product->images->first()?->image_path }}"
                                                        class="img-fluid mx-auto d-block" alt="product picture">
                                                    {{-- <div class="deal-badge">
                                                        <span class="badge bg-danger">15% Off</span>
                                                    </div> --}}
                                                    <div class="view">
                                                        <a href="#!" class="view-btn"data-id="{{ $product->id }}">
                                                            <i class="bi bi-eye-fill" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" data-bs-title="Xem nhanh"></i>
                                                        </a>
                                                        @if ($product->price > 0)
                                                            <button type="submit" class="btn view-btn">
                                                                <i class="bi bi-bag" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-title="Thêm vào giỏi hàng"></i>
                                                            </button>
                                                        @else
                                                            <a href="#!" data-bs-toggle="modal"
                                                                data-bs-target="#contactModal" class="view-btn">
                                                                <i class="bi bi-telephone-outbound"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    data-bs-title="Liên hệ"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="con-wrap mt-4">
                                                    <a href="{{ route('product.detail', $product->id) }}"
                                                        class="mb-2 d-block text text-truncate">{{ $product->name }}</a>
                                                    <div class="rating-cover mb-1">
                                                        @php
                                                            $rating =
                                                                $product->reviews->count() > 0
                                                                    ? $product->reviews->sum('rating') /
                                                                        $product->reviews->count()
                                                                    : 5;
                                                        @endphp

                                                        <span class="ml-5">

                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i
                                                                    class="bi {{ $i <= $rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                                            @endfor
                                                        </span>
                                                    </div>

                                                    @if ($product->price > 0)
                                                        <div class="align-self-center mb-2 product-price">
                                                            <span
                                                                class="ms-1 fs-6 fw-bold">{{ $product->has_sale ? number_format($product->sale_price) : number_format($product->price) }}
                                                                đ</span>
                                                            <span
                                                                class="text-decoration-line-through text-muted">{{ $product->has_sale ? number_format($product->price) . ' đ' : '' }}
                                                            </span>
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-between align-items-center flex-column">

                                                            <button type="submit"
                                                                class="btn custom-demo-btn w-100 m-0 ">Thêm vào
                                                                giỏ
                                                                hàng<i class="bi bi-bag ms-2"></i></button>
                                                        </div>
                                                    @else
                                                        <div class="align-self-center mb-2 product-price">
                                                            Giá: <span class="ms-1 fs-6 fw-bold">Liên hệ</span>
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-between align-items-center flex-column">

                                                            <a data-bs-toggle="modal" data-bs-target="#contactModal"
                                                                class="btn custom-demo-btn w-100 m-0 ">
                                                                <i class="bi bi-telephone-outbound me-2"></i>Liên hệ ngay
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @empty
                                    <p class="text-center">Không có sản phẩm nào</p>
                                @endforelse
                            </div>
                            <div class="row">
                                <div class="col-12 text-center mt-4 animate__animated wow animate__backInUp">
                                    <div class="custom-button">
                                        <a href="{{ route('product.index') }}" class="fw-bold link-ef">
                                            Xem thêm sản phẩm<i class="bi bi-arrow-right ps-2"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab">

                            <div class="row mb-4">
                                @forelse ($saleProducts as $product)
                                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                                        <form class="form-add-to-cart" method="POST">
                                            <input type="text" name="product_id" hidden value="{{ $product->id }}">
                                            <div class="card-wrap theme-border-radius px-4 py-4">
                                                <div class="con-img-wrap m-auto product-quick-view">
                                                    <img src="{{ $product->images->first()?->image_path }}"
                                                        class="img-fluid mx-auto d-block" alt="product picture">
                                                    {{-- <div class="deal-badge">
                                                        <span class="badge bg-danger">15% Off</span>
                                                    </div> --}}
                                                    <div class="view">
                                                        <a href="#!" class="view-btn"data-id="{{ $product->id }}">
                                                            <i class="bi bi-eye-fill" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" data-bs-title="Xem nhanh"></i>
                                                        </a>
                                                        @if ($product->price > 0)
                                                            <button type="submit" class="btn view-btn">
                                                                <i class="bi bi-bag" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-title="Thêm vào giỏi hàng"></i>
                                                            </button>
                                                        @else
                                                            <a href="#!" data-bs-toggle="modal"
                                                                data-bs-target="#contactModal" class="view-btn">
                                                                <i class="bi bi-telephone-outbound"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    data-bs-title="Liên hệ"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="con-wrap mt-4">
                                                    <a href="{{ route('product.detail', $product->id) }}"
                                                        class="mb-2 d-block text text-truncate">{{ $product->name }}</a>
                                                    <div class="rating-cover mb-1">
                                                        @php
                                                            $rating =
                                                                $product->reviews->count() > 0
                                                                    ? $product->reviews->sum('rating') /
                                                                        $product->reviews->count()
                                                                    : 5;
                                                        @endphp

                                                        <span class="ml-5">

                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i
                                                                    class="bi {{ $i <= $rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                                            @endfor
                                                        </span>
                                                    </div>

                                                    @if ($product->price > 0)
                                                        <div class="align-self-center mb-2 product-price">
                                                            <span
                                                                class="ms-1 fs-6 fw-bold">{{ $product->has_sale ? number_format($product->sale_price) : number_format($product->price) }}
                                                                đ</span>
                                                            <span
                                                                class="text-decoration-line-through text-muted">{{ $product->has_sale ? number_format($product->price) . ' đ' : '' }}
                                                            </span>
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-between align-items-center flex-column">

                                                            <button type="submit"
                                                                class="btn custom-demo-btn w-100 m-0 ">Thêm vào
                                                                giỏ
                                                                hàng<i class="bi bi-bag ms-2"></i></button>
                                                        </div>
                                                    @else
                                                        <div class="align-self-center mb-2 product-price">
                                                            Giá: <span class="ms-1 fs-6 fw-bold">Liên hệ</span>
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-between align-items-center flex-column">

                                                            <a data-bs-toggle="modal" data-bs-target="#contactModal"
                                                                class="btn custom-demo-btn w-100 m-0 ">
                                                                <i class="bi bi-telephone-outbound me-2"></i>Liên hệ ngay
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @empty
                                    <p class="text-center">Không có sản phẩm nào</p>
                                @endforelse
                            </div>
                            <div class="row">
                                <div class="col-12 text-center mt-4 animate__animated wow animate__backInUp">
                                    <div class="custom-button">
                                        <a href="{{ route('product.index') }}" class="fw-bold link-ef">
                                            Xem thêm sản phẩm<i class="bi bi-arrow-right ps-2"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- view all category button -->

        </div>
    </section>
    <!-- about us section -->
    <section class="about-us mb-5">
        <div class="container">
            <div class="row mt-5">
                <div class="col-12 col-lg-7 align-self-center left animate__animated wow animate__backInUp">
                    <img src="/assets/images/section/story-main.png" class="img-fluid" alt="Basket Image">
                </div>
                <div class="col-12 col-lg-5">
                    <div class="p-4">
                        <span class="high-text ms-3"></span>
                        <h2 class="fs-1 fw-bold theme-text-primary mb-3 animate__animated wow animate__backInUp">
                            Cửa hàng của chúng tôi</h2>
                        <p class="mb-5 theme-text-accent-one max animate__animated wow animate__backInUp">
                            Cửa hàng chuyên về xe đạp Giant Liv Rove 4 Disc chính hãng.
                        </p>
                        <ul>
                            <li class="mb-5 animate__animated wow animate__backInUp">
                                <h3 class="fs-5 fw-bold theme-text-primary mb-3 align-self-center">
                                    Điểm nổi bật của cửa hàng:
                                </h3>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-check2-circle fs-2 theme-text-secondary"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-0 theme-text-accent-one">Sản phẩm chất lượng cao, chính hãng 100%.</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-check2-circle fs-2 theme-text-secondary"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-0 theme-text-accent-one">Đội ngũ nhân viên am hiểu, nhiệt tình tư vấn.
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-check2-circle fs-2 theme-text-secondary"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-0 theme-text-accent-one">Chính sách bảo hành uy tín.</p>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-check2-circle fs-2 theme-text-secondary"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-0 theme-text-accent-one">Nhiều ưu đãi hấp dẫn.</p>
                                    </div>
                                </div>
                            </li>
                            <!-- repetable -->
                            <li class="mb-5 animate__animated wow animate__backInUp">
                                <h3 class="fs-5 fw-bold theme-text-primary mb-3 align-self-center">Liên hệ</h3>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-check2-circle fs-2 theme-text-secondary"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-0 theme-text-accent-one">Thông tin liên hệ</p>
                                    </div>
                                </div>
                            </li>
                            <!-- repetable -->
                        </ul>
                        <div class=" custom-button justify-content-start animate__animated wow animate__backInUp">
                            <a href="{{ route('aboutUs') }}"
                                class="btn custom-btn-secondary theme-border fw-bold button-effect px-5">
                                Khám phá ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- video demo section -->
    <section class="deal-to-action animate__animated wow animate__backInUp">
        <div class="container">
            <div class="row">
                <div class="col-12 position-relative justify-content-center align-self-center text-center">
                    <div class="mb-5">
                        <div class="max">
                            <h4 class="display-4 fw-bold theme-text-primary mb-3">Video giới thiệu sản phẩm, hoặc các video
                                khác
                            </h4>
                        </div>
                        <p class="fs-5 mb-0">Mô tả giới thiệu video</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="video-frame">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-lg-1">
                        <div class="group custom-button">
                            <div class="d-flex align-items-center position-relative">
                                <a href="https://www.youtube.com/watch?v=_0Yfkq1eysE"
                                    class="video-icon video-icon2 video_model">
                                    <i class="bi bi-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- why us section -->
    <section class="why-us">
        <div class="container">
            <div class="row my-3">
                <div class="col-12 animate__animated wow animate__backInUp">
                    <span class="high-text"></span>
                    <div class="ms-0">
                        <h2 class="fs-1 fw-bold text-start theme-text-primary mb-3">Đồng hành cùng bạn trên con đường khám
                            phá mọi hành trình</h2>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="mb-5 text-start">Khám phá thế giới xe đạp đa dạng với hàng ngàn mẫu mã, thông tin chi
                                tiết và đội ngũ tư vấn chuyên nghiệp sẵn sàng hỗ trợ bạn</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-0">
                <div class="col-12 col-md-6 col-lg-3 animate__animated wow animate__backInUp">
                    <div class="left-icon align-items-center">
                        <div class="icon">
                            <img src="/assets/images/icons/why-icon04.svg" alt="free shipping">
                        </div>
                        <div class="text">
                            <h3 class="icon-box-title">Thanh toán an toàn</h3>
                            <p>Thanh toán đa dạng, an toàn tuyệt đối với các cổng thanh toán uy tín.</p>
                        </div>
                    </div>
                </div>

                <!-- repetable -->
                <div class="col-12 col-md-6 col-lg-3 animate__animated wow animate__backInUp">
                    <div class="left-icon align-items-center">
                        <div class="icon">
                            <img src="/assets/images/icons/why-icon02.svg" alt="free shipping">
                        </div>
                        <div class="text">
                            <h3 class="icon-box-title">Đảm bảo</h3>
                            <p>Cam kết sản phẩm chính hãng, chất lượng hàng đầu</p>
                        </div>
                    </div>
                </div>
                <!-- repetable -->
                <div class="col-12 col-md-6 col-lg-3 animate__animated wow animate__backInUp">
                    <div class="left-icon align-items-center">
                        <div class="icon">
                            <img src="/assets/images/icons/why-icon03.svg" alt="free shipping">
                        </div>
                        <div class="text">
                            <h3 class="icon-box-title">Cần hỗ trợ</h3>
                            <p>Đội ngũ tư vấn viên nhiệt tình sẵn sàng hỗ trợ bạn qua chat trực tuyến, điện thoại và email.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- repetable -->
                <div class="col-12 col-md-6 col-lg-3 animate__animated wow animate__backInUp">
                    <div class="left-icon align-items-center">
                        <div class="icon">
                            <img src="/assets/images/icons/why-icon01.svg" alt="free shipping">
                        </div>
                        <div class="text">
                            <h3 class="icon-box-title">Miễn phí vận chuyển</h3>
                            <p>Miễn phí vận chuyển cho đơn hàng từ [giá trị đơn hàng] hoặc trong khu vực [khu vực]</p>
                        </div>
                    </div>
                </div>
                <!-- repetable -->
            </div>
        </div>
    </section>
    <!-- testimonials section -->
    <section class="testimonials py-5 animate__animated wow animate__backInUp">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <span class="high-text"></span>
                    <h4 class="fs-1 fw-bold text-start theme-text-primary mb-3">Sự hài lòng của khách hàng</h4>
                </div>
            </div>
            <!-- testimonials Slider-->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="carouselTestimonials mb-5">
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <div class="review-wrap">
                                    <div class="client-con mt-5 mt-lg-0">
                                        <div class="client-pic">
                                            <figure class="mb-0 avatar">
                                                <img src="/assets/images/customer/avatar-client01.png" class="img-fluid"
                                                    alt="client review">
                                            </figure>
                                        </div>
                                        <span class="fs-4 text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </span>
                                        <div class="d-flex flex-column mt-2">
                                            <span class="fs-5 fw-bold mb-2">Bảo hân</span>
                                            <span class="theme-text-primary">Khách hàng</span>
                                        </div>
                                        <p class="fs-5 my-4 lh-lg con">
                                            Cửa hàng có rất nhiều loại xe đạp, từ xe địa hình
                                            đến xe đường phố, xe cho trẻ em nữa. Mình rất hài
                                            lòng với chiếc xe vừa mua, chất lượng rất tốt, đi
                                            êm và chắc chắn. Nhân viên tư vấn nhiệt tình, giúp
                                            mình chọn được chiếc xe phù hợp với nhu cầu.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- repeatable-->
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <div class="review-wrap">
                                    <div class="client-con mt-5 mt-lg-0">
                                        <div class="client-pic">
                                            <figure class="mb-0 avatar">
                                                <img src="/assets/images/customer/avatar-client02.png" class="img-fluid"
                                                    alt="client review">
                                            </figure>
                                        </div>
                                        <span class="fs-4 text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </span>
                                        <div class="d-flex flex-column mt-2">
                                            <span class="fs-5 fw-bold mb-2">Minh Ngọc</span>
                                            <span class="theme-text-primary">Khách hàng </span>
                                        </div>
                                        <p class="fs-5 my-4 lh-lg con">
                                            Mình là người mới bắt đầu tìm hiểu về xe đạp,
                                            nhưng nhân viên ở đây đã giải thích rất cặn kẽ
                                            và giúp mình chọn được chiếc xe đầu tiên ưng ý.
                                            Họ còn hướng dẫn mình cách bảo dưỡng xe nữa.
                                            Cảm ơn cửa hàng rất nhiều!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- repeatable-->
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <div class="review-wrap">
                                    <div class="client-con mt-5 mt-lg-0">
                                        <div class="client-pic">
                                            <figure class="mb-0 avatar">
                                                <img src="/assets/images/customer/avatar-client03.png" class="img-fluid"
                                                    alt="client review">
                                            </figure>
                                        </div>
                                        <span class="fs-4 text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </span>
                                        <div class="d-flex flex-column mt-2">
                                            <span class="fs-5 fw-bold mb-2">Minh Nhi</span>
                                            {{-- <span class="theme-text-primary">Lineroad</span> --}}
                                        </div>
                                        <p class="fs-5 my-4 lh-lg con">
                                            Mua xe đạp ở đây rất thoải mái. Cửa hàng trưng bày đẹp mắt, dễ dàng xem và lựa
                                            chọn. Giá cả cũng rất hợp lý so với chất lượng xe. Chắc chắn sẽ quay lại ủng hộ!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- repeatable-->
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <div class="review-wrap">
                                    <div class="client-con mt-5 mt-lg-0">
                                        <div class="client-pic">
                                            <figure class="mb-0 avatar">
                                                <img src="/assets/images/customer/avatar-client04.png" class="img-fluid"
                                                    alt="client review">
                                            </figure>
                                        </div>
                                        <span class="fs-4 text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </span>
                                        <div class="d-flex flex-column mt-2">
                                            <span class="fs-5 fw-bold mb-2">Hồng Nhung</span>
                                            {{-- <span class="theme-text-primary">Blinkit IT</span> --}}
                                        </div>
                                        <p class="fs-5 my-4 lh-lg con">
                                            Mình tin tưởng lựa chọn cửa hàng này vì thấy rất chuyên nghiệp. Xe đạp đều là
                                            hàng chính hãng, có bảo hành đầy đủ. Mua xe ở đây cảm thấy yên tâm hơn hẳn.
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- repeatable-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="blog py-5 animate__animated wow animate__backInUp">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <span class="high-text"></span>
                    <h2 class="fs-1 fw-bold text-start theme-text-primary mb-3">Khám Phá Thế Giới Xe Đạp</h2>
                    <p class="mb-0 text-start">Đọc các bài viết hữu ích giúp bạn hiểu rõ hơn về xe đạp và đưa ra quyết định mua sắm thông minh.</p>
                </div>
            </div>
            <div class="row mt-5">
                @forelse ($blogs as $blog)
                <div class="col-12 col-lg-6 mb-4">
                    <div class="blog-card row g-0">
                        <div class="overflow-hidden position-relative col-12 theme-border-radius">
                            <figure class="mb-0 img-effect">
                                <img src="{{ $blog->image }}" class="img-fluid" alt="news articles">
                            </figure>
                        </div>
                        <div class="col-12 mt-3">
                            <a href="#"><span class="cat fw-bold fs-6">{{ $blog->created_at }}</span></a>
                            <a href="javascript:void(0)" class="font-small fw-bold theme-text-accent-one">
                                <i class="bi bi-person ms-2 theme-text-primary"></i>
                                <span>{{ $blog->user?->employee?->name }}</span>
                            </a>
                            <h2 class="fs-4 fw-bold my-3">{{ $blog->title }}</h2>
                            <div class="d-flex">
                                <a href="javascript:void(0)" class="font-small fw-bold link-more">Xem thêm<i
                                        class="bi bi-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <p class="text-center">Không có bài viết nào</p>
                @endforelse 
            </div>
        </div>
    </section> --}}
    <div class="partners">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 animate__animated wow animate__backInUp">
                    <span class="high-text"></span>
                    <h2 class="fs-1 fw-bold text-start theme-text-primary mb-3">Thương thiệu</h2>
                </div>
            </div>
            <div class="row align-items-center carouselPartner animate__animated wow animate__backInUp">
                <div class="col">
                    <img src="/assets/images/partner/logo01.png" alt="Partner" class="img-lt">
                </div>
                <div class="col">
                    <img src="/assets/images/partner/logo02.png" alt="Partner" class="img-lt">
                </div>
                <div class="col">
                    <img src="/assets/images/partner/logo03.png" alt="Partner" class="img-lt">
                </div>
                <div class="col">
                    <img src="/assets/images/partner/logo04.png" alt="Partner" class="img-lt">
                </div>
                <div class="col">
                    <img src="/assets/images/partner/logo05.png" alt="Partner" class="img-lt">
                </div>
                <div class="col">
                    <img src="/assets/images/partner/logo06.png" alt="Partner" class="img-lt">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.category-level-1').forEach((element) => {
            element.addEventListener('click', () => {
                const isActive = element.classList.contains('active');

                document.querySelectorAll('.category-level-1.active, .category-level-2.active').forEach((
                    el) => {
                    el.classList.remove('active');
                    const icon = el.querySelector('i');
                    if (icon) {
                        icon.classList.remove('fa-angle-up');
                        icon.classList.add('fa-angle-down');
                    }
                });

                if (!isActive) {
                    element.classList.add('active');
                    const icon = element.querySelector('i');

                    if (icon) {
                        icon.classList.remove('fa-angle-down');
                        icon.classList.add('fa-angle-up');
                    }
                    const id = element.getAttribute('id').replace('category-id-', '');

                    const subCategory = document.querySelector(`#category-parent-${id}`);
                    if (subCategory) {
                        subCategory.classList.add('active');
                    }
                }
            })
        })
    </script>
@endsection
