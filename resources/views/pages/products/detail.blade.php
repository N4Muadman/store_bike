@extends('layout')
@section('title', $product->name)

@section('content')
    <div class="py-5 theme-bg-accent-three">
        <div class="container">
            <!-- row -->
            <div class="row ">
                <!-- col -->
                <div class="col-12 align-self-center">
                    <!-- breadcrumb -->
                    <div class="page-breadcrumb">
                        <ul class="list">
                            <li><a href="/">Trang chủ</a></li>
                            <li><a href="{{ url()->previous() }}">Sản phẩm</a></li>
                            <li>Chi tiết sản phẩm</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shop details - horizontal view section -->
    <div class="my-5 shop-layout">
        <div class="container">
            <div class="row p-5">
                <div class="col-lg-6">
                    <!-- product gallery -->
                    <div class="product-gallery">
                        <div class="slider slider-for">
                            @foreach ($product->images as $image)
                                <div class="zoom" onmousemove="zoom(event)"
                                    style="background-image: url({{ $image->image_path }})">
                                    <img src="{{ $image->image_path }}" alt="Cycling" style="max-height: 400px">
                                </div>
                            @endforeach
                        </div>
                        <div class="slider slider-nav gallery-thumb">
                            @foreach ($product->images as $image)
                                <div>
                                    <img src="{{ $image->image_path }}" alt="Cycling store" style="max-height: 125px">
                                </div>
                            @endforeach
                        </div>
                        <!-- products thumb -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ps-lg-2 mt-5 mt-lg-0">
                        <form class="form-add-to-cart" method="POST">
                            <input type="text" name="product_id" hidden value="{{ $product->id }}">
                            {{-- <a href="#!" class="mb-3 d-block mt-3 mt-lg-0">Outdoor Products</a> --}}
                            <h1 class="mb-1 text h1 fw-bold">{{ $product->name }}</h1>
                            <div class="mb-4">
                                @php
                                    $rating =
                                        $product->reviews->count() > 0
                                            ? $product->reviews->sum('rating') / $product->reviews->count()
                                            : 5;
                                @endphp
                                <small class="text-warning">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi {{ $i <= $rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                    @endfor
                                </small>
                                <a href="#" class="ms-2">({{ $product->reviews->count() }} Đánh giá)</a>
                            </div>
                            @if ($product->price > 0)
                                <div class="fs-4">
                                    <span
                                        class="fw-bold text-dark">{{ $product->has_sale ? number_format($product->sale_price) : number_format($product->price) }}
                                        đ</span>
                                    <span
                                        class="text-decoration-line-through text-muted">{{ $product->has_sale ? number_format($product->price) . ' đ' : '' }}</span>
                                </div>
                                <hr class="my-6">
                                <div>
                                    <!-- input -->
                                    <!-- input -->
                                    <div class="input-group input-spinner">
                                        <span class="button-minus btn btn-sm">-</span>
                                        <input type="text" value="1"
                                            class="quantity-field form-control-sm form-input">
                                        <span class="button-plus btn btn-sm">+</span>
                                    </div>
                                </div>
                                <div class="mt-0 mt-lg-3 row justify-content-start g-2 align-items-center">
                                    <div class="col-12 col-md-6">
                                        <!-- button -->
                                        <div class="custom-button">
                                            <button type="submit"
                                                class="custom-btn-secondary font-small button-effect justify-content-center align-items-center d-flex px-4 transition-3d-hover w-100">
                                                <i class="bi bi-basket me-2"></i>Thêm vào giỏ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <p class="fs-3">Giá: <a class="text">Liên hệ</a></p>
                                <hr class="my-6">
                                <div class="mt-0 mt-lg-3 row justify-content-start g-2 align-items-center">
                                    <div class="col-6">
                                        <!-- button -->
                                        <div class="custom-button">
                                            <a data-bs-toggle="modal" data-bs-target="#contactModal"
                                                class="btn custom-demo-btn m-0 btn-contact" data-id="{{ $product->id }}">
                                                <i class="bi bi-telephone-outbound me-2"></i>Liên hệ ngay
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="my-3">
                                {!! $product->short_description !!}
                            </div>
                            <hr class="my-6">
                            <div>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Mã sản phẩm:</td>
                                            <td>{{ $product->id }}</td>
                                        </tr>
                                        <tr>
                                            <td>Danh mục sản phẩm:</td>
                                            <td>{{ $product->category?->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Trạng thái:</td>
                                            <td>
                                                {!! $product->stock_quantity > 0
                                                    ? '<span class="badge text-bg-success">Còn hàng</span>'
                                                    : '<span class="badge text-bg-danger">Hết hàng</span>' !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Vận chuyển:</td>
                                            <td>
                                                <small>Giao hàng trong 03 ngày.<span class="text-muted">(Giao hàng miễn
                                                        phí hôm nay)</span></small>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-8">
                                <!-- dropdown -->
                                <div class="dropdown">
                                    <a class="btn btn-outline-secondary rounded-pill dropdown-toggle" href="#"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Chia sẻ
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" target="__blank"
                                                href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('product.detail', $product->id)) }}"><i
                                                    class="bi bi-facebook me-2"></i>Facebook</a></li>
                                        <li><a class="dropdown-item" target="__blank"
                                                href="https://twitter.com/intent/tweet?status={{ urlencode($product->name . ' ' . route('product.detail', $product->id)) }}"><i
                                                    class="bi bi-twitter-x me-2"></i>Twitter</a></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shop details - Product Brief section -->
    <div class="mt-lg-5 mt-5 shop-detail">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills nav-lb-tab" id="myTab" role="tablist">
                        <!-- nav item -->
                        <li class="nav-item" role="presentation">
                            <!-- btn --> <button class="nav-link active" id="product-tab" data-bs-toggle="tab"
                                data-bs-target="#product-tab-pane" type="button" role="tab"
                                aria-controls="product-tab-pane" aria-selected="true">Mô tả</button>
                        </li>
                        <!-- nav item -->
                        <li class="nav-item" role="presentation">
                            <!-- btn --> <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                data-bs-target="#reviews-tab-pane" type="button" role="tab"
                                aria-controls="reviews-tab-pane" aria-selected="false" tabindex="-1">Chính sách vận
                                chuyển</button>
                        </li>
                    </ul>
                    <!-- tab content -->
                    <div class="tab-content" id="myTabContent">
                        <!-- tab pane -->
                        <div class="tab-pane fade show active" id="product-tab-pane" role="tabpanel"
                            aria-labelledby="product-tab" tabindex="0">
                            <div class="my-5">
                                <h2 class="fs-3 mb-3">Mô tả sản phẩm</h2>
                                {!! $product->description !!}
                            </div>
                        </div>
                        <!-- tab pane -->
                        <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab"
                            tabindex="0">
                            <h2 class="fs-3 mb-3">Chính sách vận chuyển</h2>
                            <p class="mb-2"><strong>1. Phạm vi giao hàng:</strong> Chúng tôi giao hàng toàn quốc, áp dụng
                                cho tất cả các tỉnh thành tại Việt Nam.</p>
                            <p class="mb-2"><strong>2. Thời gian giao hàng:</strong>
                                - Khu vực nội thành Hà Nội và TP.HCM: từ 1 - 2 ngày làm việc.<br>
                                - Các tỉnh thành khác: từ 3 - 5 ngày làm việc tùy vị trí địa lý.
                            </p>
                            <p class="mb-2"><strong>3. Đơn vị vận chuyển:</strong> Chúng tôi hợp tác với các đối tác uy
                                tín như Giao Hàng Nhanh, Viettel Post, J&T Express để đảm bảo giao hàng đúng hẹn và an toàn.
                            </p>
                            <p class="mb-2"><strong>4. Phí vận chuyển:</strong>
                                - Miễn phí vận chuyển cho đơn hàng từ 2.000.000 VNĐ trở lên.<br>
                                - Với đơn hàng dưới 2.000.000 VNĐ, phí vận chuyển được tính theo bảng giá của đối tác vận
                                chuyển.
                            </p>
                            <p class="mb-2"><strong>5. Kiểm tra hàng:</strong> Quý khách có quyền kiểm tra sản phẩm trước
                                khi thanh toán. Nếu phát hiện hàng hóa bị hư hỏng, móp méo hoặc sai mẫu mã, vui lòng từ chối
                                nhận hàng và liên hệ với chúng tôi để được hỗ trợ.</p>
                            <p class="mb-2"><strong>6. Giao hàng thất bại:</strong> Nếu không thể giao hàng do quý khách
                                không có mặt hoặc cung cấp sai thông tin, chúng tôi sẽ liên hệ lại để sắp xếp giao lại trong
                                thời gian sớm nhất.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- review section -->
    <div class="my-5 shop-detail-review">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-4">
                    <div class="me-lg-12 mb-5 mb-md-0">
                        <div class="mb-5">
                            <!-- title -->
                            <p class="mb-3 fs-4 fw-bold theme-text-primary">Đánh giá của khách hàng</p>
                            <span>
                                <small class="text-warning">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi {{ $i <= $rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                    @endfor
                                </small>
                                <span class="ms-3">{{ $rating }} / 5</span>
                            </span>
                        </div>
                        <div class="mb-5">
                            @php
                                $reviews = $product->reviews;
                                $_5starRating = 0;
                                $_4starRating = 0;
                                $_3starRating = 0;
                                $_2starRating = 0;
                                $_1starRating = 0;
                                if ($reviews->count() > 0) {
                                    $_5starRating = ($reviews->where('rating', 5)->count() / $reviews->count()) * 100;
                                    $_4starRating = ($reviews->where('rating', 4)->count() / $reviews->count()) * 100;
                                    $_3starRating = ($reviews->where('rating', 3)->count() / $reviews->count()) * 100;
                                    $_2starRating = ($reviews->where('rating', 2)->count() / $reviews->count()) * 100;
                                    $_1starRating = ($reviews->where('rating', 1)->count() / $reviews->count()) * 100;
                                }
                            @endphp
                            <!-- progress -->
                            <div class="d-flex align-items-center mb-2">
                                <div class="text-nowrap me-3 text-muted"><span
                                        class="d-inline-block align-middle text-muted">5</span><i
                                        class="bi bi-star-fill ms-1 small text-warning"></i></div>
                                <div class="w-100">
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-warning" role="progressbar"
                                            style="width: {{ $_5starRating }}%;"></div>
                                    </div>
                                </div><span class="text-muted ms-3">{{ $_5starRating }}%</span>
                            </div>
                            <!-- progress -->
                            <div class="d-flex align-items-center mb-2">
                                <div class="text-nowrap me-3 text-muted"><span
                                        class="d-inline-block align-middle text-muted">4</span><i
                                        class="bi bi-star-fill ms-1 small text-warning"></i></div>
                                <div class="w-100">
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-warning" role="progressbar"
                                            style="width: {{ $_4starRating }}%;"></div>
                                    </div>
                                </div><span class="text-muted ms-3">{{ $_4starRating }}%</span>
                            </div>
                            <!-- progress -->
                            <div class="d-flex align-items-center mb-2">
                                <div class="text-nowrap me-3 text-muted"><span
                                        class="d-inline-block align-middle text-muted">3</span><i
                                        class="bi bi-star-fill ms-1 small text-warning"></i></div>
                                <div class="w-100">
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-warning" role="progressbar"
                                            style="width: {{ $_3starRating }}%;"></div>
                                    </div>
                                </div><span class="text-muted ms-3">{{ $_3starRating }}%</span>
                            </div>
                            <!-- progress -->
                            <div class="d-flex align-items-center mb-2">
                                <div class="text-nowrap me-3 text-muted"><span
                                        class="d-inline-block align-middle text-muted">2</span><i
                                        class="bi bi-star-fill ms-1 small text-warning"></i></div>
                                <div class="w-100">
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-warning" role="progressbar"
                                            style="width: {{ $_2starRating }}%;"></div>
                                    </div>
                                </div><span class="text-muted ms-3">{{ $_2starRating }}%</span>
                            </div>
                            <!-- progress -->
                            <div class="d-flex align-items-center mb-2">
                                <div class="text-nowrap me-3 text-muted"><span
                                        class="d-inline-block align-middle text-muted">1</span><i
                                        class="bi bi-star-fill ms-1 small text-warning"></i></div>
                                <div class="w-100">
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-warning" role="progressbar"
                                            style="width: {{ $_1starRating }}%;"></div>
                                    </div>
                                </div><span class="text-muted ms-3">{{ $_1starRating }}%</span>
                            </div>
                        </div>
                        <div class="mt-1">
                            <p class="mb-0 fs-4 fw-bold theme-text-primary">Đánh giá sản phẩm này</p>
                            <p class="mb-0 theme-text-accent-one small">Chia sẻ suy nghĩ của bạn với những khách hàng khác.
                            </p>
                        </div>
                        <div>
                            <form action="{{ route('review.product', $product->id) }}" method="post">
                                @csrf
                                <div class="py-3">
                                    <input class="form-control" type="text" placeholder="Nhập họ tên của bạn"
                                        name="full_name" required>
                                </div>
                                <div class="py-3">
                                    <input class="form-control" type="email" placeholder="Nhập email của bạn"
                                        name="email" required>
                                </div>

                                <div class="py-3">
                                    <textarea class="form-control" name="content" rows="3" required placeholder="Nội dung"></textarea>
                                </div>
                                <div class="rating-input">
                                    <small class="text-warning star-input" data-rating="1"><i
                                            class="bi bi-star-fill"></i></small>
                                    <small class="text-warning star-input" data-rating="2"><i
                                            class="bi bi-star-fill"></i></small>
                                    <small class="text-warning star-input" data-rating="3"><i
                                            class="bi bi-star-fill"></i></small>
                                    <small class="text-warning star-input" data-rating="4"><i
                                            class="bi bi-star-fill"></i></small>
                                    <small class="text-warning star-input" data-rating="5"><i
                                            class="bi bi-star-fill"></i></small>
                                    <input type="hidden" id="selectedRating" name="rating" value="0">
                                </div>
                                <!-- button -->
                                <div class="d-flex justify-content-end custom-button">
                                    <button href="#"
                                        class="theme-border custom-btn-secondary button-effect px-4">Đánh giá</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- col -->
                <div class="col-md-8">
                    <div class="mb-5">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div>
                                <p class="mb-0 fs-4 fw-bold theme-text-primary">Đánh giá</p>
                            </div>
                            {{-- <div>
                                <select class="border theme-border-radius px-2" aria-label="Default select example">
                                    <option selected="">Top Review</option>
                                    <option value="1">Most Recent</option>
                                    <option value="2">Highest Rating</option>
                                    <option value="3">Lowest Rating</option>
                                </select>
                            </div> --}}
                        </div>
                        @forelse ($product->reviews as $review)
                            <div class="d-flex border-bottom pb-3 mb-3">
                                <img src="/assets/images/avatar/avatar-1.jpg" alt="avatar"
                                    class="rounded-circle avatar-lg">
                                <div class="ms-5">
                                    <p class="mb-1 theme-text-primary fw-bold">{{ $review->full_name }}</p>
                                    <!-- content -->
                                    <p class="font-extra-small"> <span
                                            class="text-muted">{{ $review->created_at }}</span>
                                        {{-- <span class="text-primary ms-3 fw-bold">Verified Purchase</span> --}}
                                    </p>
                                    <!-- rating -->
                                    <div class=" mb-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}  text-warning"></i>
                                        @endfor
                                    </div>
                                    <!-- text-->
                                    <p class="theme-text-accent-one small">{{ $review->content }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">Không có đánh giá nào</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Start -->
    {{-- <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Chi Tiết Sản Phẩm</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>

                                <li class="breadcrumb-item active">Chi tiết sản phẩm</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-9 col-xl-8 col-lg-7 wow fadeInUp">
                    <div class="row g-4">
                        <div class="col-xl-6 wow fadeInUp">
                            <div class="product-left-box">
                                <div class="row g-2">
                                    <div class="col-xxl-10 col-lg-12 col-md-10 order-xxl-2 order-lg-1 order-md-2">
                                        <div class="product-main-2 no-arrow">

                                            @foreach ($product->images as $key => $image)
                                                <div>
                                                    <div class="slider-image">
                                                        <img src="{{ $image->image_path }}"
                                                            id="{{ $key == 0 ? 'img-1' : '' }}"
                                                            data-zoom-image="{{ $image->image_path }}"
                                                            class="img-fluid image_zoom_cls-0 blur-up lazyload"
                                                            alt="">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-xxl-2 col-lg-12 col-md-2 order-xxl-1 order-lg-2 order-md-1">
                                        <div class="left-slider-image-2 left-slider no-arrow slick-top">
                                            @foreach ($product->images as $image)
                                                <div>
                                                    <div class="sidebar-image">
                                                        <img src="{{ $image->image_path }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="right-box-contain">
                                <h6 class="offer-top">Giảm giá {!! $product->has_sale
                                    ? number_format((($product->price - $product->sale_price) / $product->price) * 100, 0)
                                    : '0' !!}%</h6>
                                <h2 class="name">{{ $product->name }}</h2>
                                <div class="price-rating">
                                    <h3 class="theme-color price">
                                        {{ $product->has_sale ? number_format($product->sale_price) : number_format($product->price) }}
                                        đ <del
                                            class="text-content">{{ $product->has_sale ? number_format($product->price) . ' đ' : '' }}</del>
                                    </h3>
                                    <div class="product-rating custom-rate">
                                        @php
                                            $rating =
                                                $product->reviews->count() > 0
                                                    ? $product->reviews->sum('rating') / $product->reviews->count()
                                                    : 0;
                                        @endphp
                                        <ul class="rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <li>
                                                    <i data-feather="star" class="{{ $i <= $rating ? 'fill' : '' }}"></i>
                                                </li>
                                            @endfor
                                        </ul>
                                        <span class="review">{{ $product->reviews->count() }} Người đánh giá</span>
                                    </div>
                                </div>

                                <div class="product-contain">
                                    <p>
                                        {{ $product->short_description }}
                                    </p>
                                </div>


                                <div class="time deal-timer product-deal-timer mx-md-0 mx-auto" id="clockdiv-1"
                                    data-hours="1" data-minutes="2" data-seconds="3">
                                    <div class="product-title">
                                        <h4>Nhanh lên! Khuyến mại kết thúc vào</h4>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="days d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>Ngày</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="hours d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>Giờ</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="minutes d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>Phút</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="seconds d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>Giây</h6>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <form class="form-add-to-cart" method="post">
                                    <input type="text" name="product_id" hidden value="{{ $product->id }}">
                                    <div class="note-box product-package">
                                        <div class="cart_qty qty-box product-qty">
                                            <div class="input-group">

                                                <button type="button" class="qty-left-minus" data-type="minus"
                                                    data-field="">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                                <input class="form-control input-number qty-input" type="text"
                                                    name="quantity" value="0">
                                                <button type="button" class="qty-right-plus" data-type="plus"
                                                    data-field="">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <button type="submit"
                                            class="btn btn-md bg-dark cart-button text-white w-100">Thêm
                                            vào giỏ</button>
                                    </div>
                                </form>

                                <div class="progress-sec">
                                    <div class="left-progressbar">
                                        <h6>Xin hãy nhanh chân! Chỉ còn {{ $product->stock_quantity }} sản phẩm trong kho
                                        </h6>
                                        <div role="progressbar" class="progress warning-progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                style="width: 50%;"></div>
                                        </div>
                                    </div>
                                </div>


                                <div class="pickup-box">
                                    <div class="product-title">
                                        <h4>Thông tin sản phẩm</h4>
                                    </div>

                                    <div class="product-info">
                                        <ul class="product-info-list product-info-list-2">
                                            <li>Danh mục : <a
                                                    href="javascript:void(0)">{{ $product->category?->name }}</a>
                                            </li>
                                            <li>Mã sản phẩm : <a href="javascript:void(0)">{{ $product->id }}</a></li>
                                            <li>Còn hàng : <a href="javascript:void(0)">{{ $product->stock_quantity }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="payment-option">
                                    <div class="product-title">
                                        <h4>Đảm bảo thanh toán an toàn</h4>
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/1.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/2.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/3.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/4.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/5.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="product-section-box">
                                <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                            data-bs-target="#description" type="button" role="tab">Mô tả</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="info-tab" data-bs-toggle="tab"
                                            data-bs-target="#info" type="button" role="tab">Đặc điểm sản
                                            phẩm</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="review-tab" data-bs-toggle="tab"
                                            data-bs-target="#review" type="button" role="tab">Đánh giá</button>
                                    </li>
                                </ul>

                                <div class="tab-content custom-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                                        <div class="product-description">
                                            {!! $product->description !!}
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="info" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="table info-table">
                                                <tbody>

                                                    @foreach ($product->characteristics as $characteristic)
                                                        <tr>
                                                            <td>{{ $characteristic->name }}</td>
                                                            <td>{{ $characteristic->description }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="review" role="tabpanel">
                                        <div class="review-box">
                                            <div class="row">
                                                <div class="col-xl-5">
                                                    <div class="product-rating-box">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <div class="product-main-rating">
                                                                    <h2>3.40
                                                                        <i data-feather="star"></i>
                                                                    </h2>

                                                                    <h5>5 Overall Rating</h5>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-12">
                                                                <ul class="product-rating-list">
                                                                    <li>
                                                                        <div class="rating-product">
                                                                            <h5>5<i data-feather="star"></i></h5>
                                                                            <div class="progress">
                                                                                <div class="progress-bar"
                                                                                    style="width: 40%;">
                                                                                </div>
                                                                            </div>
                                                                            <h5 class="total">2</h5>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="rating-product">
                                                                            <h5>4<i data-feather="star"></i></h5>
                                                                            <div class="progress">
                                                                                <div class="progress-bar"
                                                                                    style="width: 20%;">
                                                                                </div>
                                                                            </div>
                                                                            <h5 class="total">1</h5>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="rating-product">
                                                                            <h5>3<i data-feather="star"></i></h5>
                                                                            <div class="progress">
                                                                                <div class="progress-bar"
                                                                                    style="width: 0%;">
                                                                                </div>
                                                                            </div>
                                                                            <h5 class="total">0</h5>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="rating-product">
                                                                            <h5>2<i data-feather="star"></i></h5>
                                                                            <div class="progress">
                                                                                <div class="progress-bar"
                                                                                    style="width: 20%;">
                                                                                </div>
                                                                            </div>
                                                                            <h5 class="total">1</h5>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="rating-product">
                                                                            <h5>1<i data-feather="star"></i></h5>
                                                                            <div class="progress">
                                                                                <div class="progress-bar"
                                                                                    style="width: 20%;">
                                                                                </div>
                                                                            </div>
                                                                            <h5 class="total">1</h5>
                                                                        </div>
                                                                    </li>

                                                                </ul>

                                                                <div class="review-title-2">
                                                                    <h4 class="fw-bold">Review this product</h4>
                                                                    <p>Let other customers know what you think</p>
                                                                    <button class="btn" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#writereview">Write a
                                                                        review</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-7">
                                                    <div class="review-people">
                                                        <ul class="review-list">
                                                            <li>
                                                                <div class="people-box">
                                                                    <div>
                                                                        <div class="people-image people-text">
                                                                            <img alt="user" class="img-fluid "
                                                                                src="../assets/images/review/1.jpg">
                                                                        </div>
                                                                    </div>
                                                                    <div class="people-comment">
                                                                        <div class="people-name"><a
                                                                                href="javascript:void(0)"
                                                                                class="name">Jack Doe</a>
                                                                            <div class="date-time">
                                                                                <h6 class="text-content"> 29 Sep 2023
                                                                                    06:40:PM
                                                                                </h6>
                                                                                <div class="product-rating">
                                                                                    <ul class="rating">
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"></i>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="reply">
                                                                            <p>Avoid this product. The quality is
                                                                                terrible, and
                                                                                it started falling apart almost
                                                                                immediately. I
                                                                                wish I had read more reviews before
                                                                                buying.
                                                                                Lesson learned.</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="people-box">
                                                                    <div>
                                                                        <div class="people-image people-text">
                                                                            <img alt="user" class="img-fluid "
                                                                                src="../assets/images/review/2.jpg">
                                                                        </div>
                                                                    </div>
                                                                    <div class="people-comment">
                                                                        <div class="people-name"><a
                                                                                href="javascript:void(0)"
                                                                                class="name">Jessica
                                                                                Miller</a>
                                                                            <div class="date-time">
                                                                                <h6 class="text-content"> 29 Sep 2023
                                                                                    06:34:PM
                                                                                </h6>
                                                                                <div class="product-rating">
                                                                                    <div class="product-rating">
                                                                                        <ul class="rating">
                                                                                            <li>
                                                                                                <i data-feather="star"
                                                                                                    class="fill"></i>
                                                                                            </li>
                                                                                            <li>
                                                                                                <i data-feather="star"
                                                                                                    class="fill"></i>
                                                                                            </li>
                                                                                            <li>
                                                                                                <i data-feather="star"
                                                                                                    class="fill"></i>
                                                                                            </li>
                                                                                            <li>
                                                                                                <i data-feather="star"
                                                                                                    class="fill"></i>
                                                                                            </li>
                                                                                            <li>
                                                                                                <i data-feather="star"></i>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="reply">
                                                                            <p>Honestly, I regret buying this item. The
                                                                                quality
                                                                                is subpar, and it feels like a waste of
                                                                                money. I
                                                                                wouldn't recommend it to anyone.</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="people-box">
                                                                    <div>
                                                                        <div class="people-image people-text">
                                                                            <img alt="user" class="img-fluid "
                                                                                src="../assets/images/review/3.jpg">
                                                                        </div>
                                                                    </div>
                                                                    <div class="people-comment">
                                                                        <div class="people-name"><a
                                                                                href="javascript:void(0)"
                                                                                class="name">Rome Doe</a>
                                                                            <div class="date-time">
                                                                                <h6 class="text-content"> 29 Sep 2023
                                                                                    06:18:PM
                                                                                </h6>
                                                                                <div class="product-rating">
                                                                                    <ul class="rating">
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"></i>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="reply">
                                                                            <p>I am extremely satisfied with this
                                                                                purchase. The
                                                                                item arrived promptly, and the quality
                                                                                is
                                                                                exceptional. It's evident that the
                                                                                makers paid
                                                                                attention to detail. Overall, a
                                                                                fantastic buy!
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="people-box">
                                                                    <div>
                                                                        <div class="people-image people-text">
                                                                            <img alt="user" class="img-fluid "
                                                                                src="../assets/images/review/4.jpg">
                                                                        </div>
                                                                    </div>
                                                                    <div class="people-comment">
                                                                        <div class="people-name"><a
                                                                                href="javascript:void(0)"
                                                                                class="name">Sarah
                                                                                Davis</a>
                                                                            <div class="date-time">
                                                                                <h6 class="text-content"> 29 Sep 2023
                                                                                    05:58:PM
                                                                                </h6>
                                                                                <div class="product-rating">
                                                                                    <ul class="rating">
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"></i>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="reply">
                                                                            <p>I am genuinely delighted with this item.
                                                                                It's a
                                                                                total winner! The quality is superb, and
                                                                                it has
                                                                                added so much convenience to my daily
                                                                                routine.
                                                                                Highly satisfied customer!</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="people-box">
                                                                    <div>
                                                                        <div class="people-image people-text">
                                                                            <img alt="user" class="img-fluid "
                                                                                src="../assets/images/review/5.jpg">
                                                                        </div>
                                                                    </div>
                                                                    <div class="people-comment">
                                                                        <div class="people-name"><a
                                                                                href="javascript:void(0)"
                                                                                class="name">John Doe</a>
                                                                            <div class="date-time">
                                                                                <h6 class="text-content"> 29 Sep 2023
                                                                                    05:22:PM
                                                                                </h6>
                                                                                <div class="product-rating">
                                                                                    <ul class="rating">
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"></i>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="reply">
                                                                            <p>Very impressed with this purchase. The
                                                                                item is of
                                                                                excellent quality, and it has exceeded
                                                                                my
                                                                                expectations.</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp">
                    <div class="right-sidebar-box">
                        <div class="vendor-box">
                            <div class="vendor-contain">
                                <div class="vendor-image">
                                    <img src="../assets/images/product/vendor.png" class="blur-up lazyload"
                                        alt="">
                                </div>

                                <div class="vendor-name">
                                    <h5 class="fw-500">Noodles Co.</h5>

                                    <div class="product-rating mt-1">
                                        <ul class="rating">
                                            <li>
                                                <i data-feather="star" class="fill"></i>
                                            </li>
                                            <li>
                                                <i data-feather="star" class="fill"></i>
                                            </li>
                                            <li>
                                                <i data-feather="star" class="fill"></i>
                                            </li>
                                            <li>
                                                <i data-feather="star" class="fill"></i>
                                            </li>
                                            <li>
                                                <i data-feather="star"></i>
                                            </li>
                                        </ul>
                                        <span>(36 Đánh giá)</span>
                                    </div>

                                </div>
                            </div>

                            <p class="vendor-detail">Noodles & Company là một nhà hàng bình dân kiểu Mỹ chuyên phục vụ các
                                món mì và mì ống của Mỹ và quốc tế.</p>

                            <div class="vendor-list">
                                <ul>
                                    <li>
                                        <div class="address-contact">
                                            <i data-feather="map-pin"></i>
                                            <h5>Địa chỉ: <span class="text-content">1288 Franklin Avenue</span></h5>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="address-contact">
                                            <i data-feather="headphones"></i>
                                            <h5>Liên hệ người bán: <span class="text-content">(+1)-123-456-789</span></h5>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Trending Product -->
                        <div class="pt-25">
                            <div class="category-menu">
                                <h3>Sản phẩm gợi ý</h3>

                                <ul class="product-list product-right-sidebar border-0 p-0">
                                    @forelse($suggestedProducts as $product)
                                        <li>
                                            <div class="offer-product">
                                                <a href="{{ route('product.detail', $product->id) }}"
                                                    class="offer-image">
                                                    <img src="{{ $product?->images[0]?->image_path }}"
                                                        class="blur-up lazyload" alt="{{ $product->name }}">
                                                </a>

                                                <div class="offer-detail">
                                                    <div>
                                                        <a href="{{ route('product.detail', $product->id) }}"
                                                            class="text-title">
                                                            <h6 class="name">{{ $product->name }}</h6>
                                                        </a>
                                                        <span> {{ $product->stock_quantity > 0 ? 'Còn Hàng' : 'Hết Hàng' }}
                                                        </span>
                                                        <h5 class="sold text-content">
                                                            <span
                                                                class="theme-color price">{{ $product->has_sale ? number_format($product->sale_price, 0, '.', ',') : number_format($product->price, 0, '.', ',') }}
                                                                đ</span>
                                                            <del>{{ $product->has_sale ? number_format($product->sale_price, 0, '.', ',') . ' đ' : '' }}</del>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <p class="text-center">Không có sản phẩm nào</p>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <!-- Banner Section -->
                        <div class="ratio_156 pt-25">
                            <div class="home-contain">
                                <img src="../assets/images/vegetable/banner/8.jpg" class="bg-img blur-up lazyload"
                                    alt="">
                                <div class="home-detail p-top-left home-p-medium">
                                    <div>
                                        <h6 class="text-yellow home-banner">Các sản phẩm</h6>
                                        <h3 class="text-uppercase fw-normal"><span class="theme-color fw-bold">Hải
                                                sản</span> Tươi mớ</h3>
                                        <button onclick="location.href = '{{ route('product.index') }}';"
                                            class="btn btn-animation btn-md fw-bold mend-auto">Mua ngay <i
                                                class="fa-solid fa-arrow-right icon"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-list-section section-b-space">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Sản phẩm liên quan</h2>
                <span class="title-leaf">
                    <svg class="icon-width">
                        <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                    </svg>
                </span>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="slider-6_1 product-wrapper">
                        @forelse ($relatedProducts as $it)
                            <form class="form-add-to-cart" method="post">
                                <input type="text" name="product_id" hidden value="{{ $it->id }}">
                                <div>
                                    <div class="product-box-3 wow fadeInUp">
                                        <div class="product-header">
                                            <div class="product-image">
                                                <a href="{{ route('product.detail', $it->id) }}">
                                                    <img src="{{ $it->images[0]?->image_path }}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>

                                                <ul class="product-option">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" class="view"
                                                        data-id="{{ $it->id }}" title="View">
                                                        <a href="javascript:void(0)">
                                                            <i data-feather="eye"></i>
                                                        </a>
                                                    </li>

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                        <a href="!#">
                                                            <i data-feather="refresh-cw"></i>
                                                        </a>
                                                    </li>

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Wishlist">
                                                        <a href="!#" class="notifi-wishlist">
                                                            <i data-feather="heart"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="product-footer">
                                            <div class="product-detail">
                                                <span class="span-name">{{ $it->category->name }}</span>
                                                <a href="{{ route('product.detail', $it->id) }}">
                                                    <h5 class="name">{{ $it->name }}</h5>
                                                </a>
                                                <div class="product-rating mt-2">
                                                    @php
                                                        $rating = $it->reviews->count()
                                                            ? $it->reviews->sum('rating') / $it->reviews->count()
                                                            : 0;
                                                    @endphp


                                                    <ul class="rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <li>
                                                                <i data-feather="star"
                                                                    class="{{ $i <= $rating ? 'fill' : '' }}"></i>
                                                            </li>
                                                        @endfor
                                                    </ul>
                                                    <span>({{ $rating }})</span>
                                                </div>

                                                <h6 class="theme-color mt-2">
                                                    {{ $it->stock_quantity > 0 ? 'Còn Hàng' : 'Hết Hàng' }}
                                                </h6>

                                                <h5 class="price"><span
                                                        class="theme-color">{{ $it->has_sale ? number_format($it->sale_price, 0, '.', ',') : number_format($it->price, 0, '.', ',') }}
                                                        đ</span>
                                                    <del>{{ $it->has_sale ? number_format($it->price, 0, '.', ',') . ' đ' : '' }}</del>
                                                </h5>
                                                <div class="add-to-cart-box bg-white">
                                                    <button class="btn btn-add-cart addcart-button" type="submit">Thêm
                                                        vào giỏ
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @empty
                            <p class="text-center">Không có sản phẩm nào</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection

@section('scripts')
    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     const stars = document.querySelectorAll("#reviewRating i");
        //     const ratingInput = document.getElementById("rating-input");

        //     stars.forEach((element) => {
        //         element.addEventListener("click", () => {
        //             const currentRating = element.dataset.rating;
        //             ratingInput.value = currentRating;
        //             stars.forEach(star => {
        //                 if (parseInt(star.getAttribute("data-rating")) <= currentRating) {
        //                     star.classList.add("active");
        //                 } else {
        //                     star.classList.remove("active");
        //                 }
        //             });
        //         })
        //     })
        // });
        $('.qty-right-plus').click(function() {
            if ($(this).prev().val() < 9) {
                $(this).prev().val(+$(this).prev().val() + 1);
            }
        });
        $('.qty-left-minus').click(function() {
            if ($(this).next().val() > 1) {
                if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
            }
        });
        const starInputs = document.querySelectorAll('.star-input');
        const selectedRatingInput = document.getElementById('selectedRating');

        starInputs.forEach(star => {
            star.addEventListener('click', function() {
                const ratingValue = parseInt(this.getAttribute('data-rating'));
                selectedRatingInput.value = ratingValue;

                starInputs.forEach(s => {
                    if (parseInt(s.getAttribute('data-rating')) <= ratingValue) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
            });

            star.addEventListener('mouseover', function() {
                const ratingValue = parseInt(this.getAttribute('data-rating'));
                starInputs.forEach(s => {
                    if (parseInt(s.getAttribute('data-rating')) <= ratingValue) {
                        s.style.color = 'orange';
                    } else {
                        s.style.color = 'gold';
                    }
                });
            });

            star.addEventListener('mouseout', function() {
                const currentRating = parseInt(selectedRatingInput.value);
                starInputs.forEach(s => {
                    if (parseInt(s.getAttribute('data-rating')) <= currentRating) {
                        s.style.color = 'gold';
                    } else {
                        s.style.color = 'gold';
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const initialRating = parseInt(selectedRatingInput.value);
            starInputs.forEach(s => {
                if (parseInt(s.getAttribute('data-rating')) <= initialRating) {
                    s.classList.add('active');
                }
            });

        });
    </script>
@endsection
