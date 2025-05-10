@extends('layout')
@section('title', 'Tất cả sản phẩm')

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
                            <li>Sản phẩm</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shop - Top Filter View section -->
    <div class="shop-layout py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- sort & filter button -->
                    <div class="d-sm-flex justify-content-between align-items-center align-items-center">
                        <div class="d-flex flex-column flex-sm-row mb-3 mb-sm-0">
                            <form action="{{ route('product.index') }}" method="get" id="sortForm">

                                @foreach (request()->except('sort') as $key => $value)
                                    @if (is_array($value))
                                        @foreach ($value as $item)
                                            <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                                        @endforeach
                                    @else
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endif
                                @endforeach

                                <select name="sort" class="border theme-border-radius min-h px-2"
                                    onchange="document.getElementById('sortForm').submit();">
                                    <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Sắp xếp: Mặc định
                                    </option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá:
                                        Nhỏ đến lớn</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá:
                                        Lớn đến nhỏ</option>
                                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Từ A-Z
                                    </option>
                                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Từ Z-A
                                    </option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Từ cũ đến
                                        mới</option>
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Từ mới đến
                                        cũ</option>
                                </select>
                            </form>
                        </div>
                        <p class="mb-3 mb-sm-0 mb-lg-0 theme-text-accent-one">Kết quả: {{ $products->count() }} sản phẩm
                        </p>
                        <!-- icon -->
                        <div class="d-md-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-block d-lg-none">
                                    <a class="fs-5 fw-bold me-2 flex-grow-1" data-bs-toggle="collapse"
                                        href="#collapseFilter" role="button" aria-expanded="false"
                                        aria-controls="collapseFilter">
                                        <i class="bi bi-funnel fs-2"></i>Bộ lọc
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex mt-2 mt-lg-0 d-none d-lg-block">
                                <!-- filter button -->
                                <a class="me-2 flex-grow-1" data-bs-toggle="collapse" href="#collapseFilter" role="button"
                                    aria-expanded="false" aria-controls="collapseFilter" title="Filter">
                                    Bộ lọc
                                    <i class="bi bi-funnel fs-4"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="collapse mt-5" id="collapseFilter">
                        <form id="filterForm" method="GET" action="{{ route('product.index') }}">
                            <div class="card card-body rounded-0">
                                <!-- filter clear section -->
                                <div class="row">
                                    <div class="col-12 mb-3 border-bottom pb-3 ">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fs-4 fw-bold">Bộ lọc</span>
                                            <a href="{{ route('product.index') }}"
                                                class="font-extra-small theme-text-primary">Xóa tất cả</a>
                                        </div>
                                        <div class="mt-2">
                                            @foreach (request()->only('category', 'brand') as $key => $values)
                                                @foreach ((array) $values as $value)
                                                    <span class="badge theme-bg-accent-three theme-text-accent-one">
                                                        {{ $value }}
                                                    </span>
                                                @endforeach
                                            @endforeach

                                            <span class="badge theme-bg-accent-three theme-text-accent-one">Khoảng giá:
                                                {{ request('price_min') ? number_format(request('price_min')) : 0 }} đ -
                                                {{ request('price_max') ? number_format(request('price_max')) : number_format(100000000) }}
                                                đ</span>

                                            @foreach ((array) request()->rating as $rating)
                                                <span class="badge theme-bg-accent-three theme-text-accent-one">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $rating)
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        @else
                                                            <i class="bi bi-star text-secondary"></i>
                                                        @endif
                                                    @endfor
                                                </span>
                                            @endforeach


                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 mb-5">
                                        <!-- title -->
                                        <h5 class="mb-3 fs-4 theme-text-primary">Danh mục</h5>
                                        @foreach ($categories as $category)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input filter-checkbox" type="checkbox"
                                                    name="category[]" {{-- dùng mảng --}} value="{{ $category->name }}"
                                                    id="cat_{{ $category->id }}"
                                                    {{ in_array($category->name, request()->input('category', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="cat_{{ $category->id }}">
                                                    {{ $category->name }} ({{ $category->products->count() }})
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-12 col-md-2 mb-5">
                                        <!-- price -->
                                        <h5 class="mb-3 fs-4 theme-text-primary">Lọc theo giá</h5>
                                        <div>
                                            <!-- range -->
                                            <div class="slider-area">
                                                <div class="slider-area-wrapper">
                                                    <div id="priceRange" class="slider"></div>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <small class="text-muted">Giá:</small>
                                                <span id="priceRange-value" class="small"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- brand -->
                                    <div class="col-12 col-md-3 mb-5">
                                        <h5 class="mb-3 fs-4 theme-text-primary">Lọc theo thương hiệu</h5>
                                        @php
                                            $brands = ['Meri Gold', 'Lilly', 'Diamond', 'Brocolos', 'Keya', 'Dalgun'];
                                        @endphp
                                        @foreach ($brands as $brand)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input filter-checkbox" type="checkbox"
                                                    name="brand[]" value="{{ $brand }}" id="brand_meri"
                                                    {{ in_array($brand, request()->input('brand', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="brand_{{ Str::slug($brand) }}">
                                                    {{ $brand }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- rating -->
                                    <div class="col-12 col-md-2 mb-5">
                                        <h5 class="mb-3 fs-4 theme-text-primary">Đánh giá</h5>
                                        <div>
                                            @for ($i = 5; $i >= 1; $i--)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input filter-checkbox" type="checkbox"
                                                        name="rating[]" value="{{ $i }}" id="ratingFive"
                                                        {{ in_array($i, request()->input('rating', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="rating_{{ $i }}">
                                                        @for ($j = 1; $j <= 5; $j++)
                                                            <i
                                                                class="bi {{ $j <= $i ? 'bi-star-fill' : 'bi-star' }} text-warning"></i>
                                                        @endfor
                                                    </label>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!-- products listing section -->
                    <div class="row mt-5">
                        @forelse ($products as $product)
                            <div class="col-12 col-md-6 col-lg-3 mb-5">
                                <form class="form-add-to-cart" method="POST">
                                    <input type="text" name="product_id" hidden value="{{ $product->id }}">
                                    <div class="card-wrap theme-border-radius border p-3">
                                        <div class="con-img-wrap m-auto product-quick-view">
                                            <img src="{{ $product->images->first()?->image_path }}"
                                                class="img-fluid mx-auto d-block" alt="product picture">
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
                                                        <i class="bi bi-telephone-outbound" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" data-bs-title="Liên hệ"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="con-wrap mt-4">
                                            <a href="{{ route('product.detail', $product->id) }}"
                                                class="mb-2 d-block text text-truncate">{{ $product->name }}</a>
                                            <div class="rating-cover ">
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
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <button class="btn mb-0 transition-3d-hover"
                                                        style="color: #e40202">Thêm vào giỏ hàng<i
                                                            class="bi bi-bag ms-2"></i></button>
                                                </div>
                                            @else
                                                <div class="align-self-center mb-2 product-price">
                                                    Giá: <a class="ms-1 fs-6 fw-bold text">Liên hệ</a>
                                                </div>

                                                <div class="d-flex justify-content-end align-items-center">

                                                    <a data-bs-toggle="modal" data-bs-target="#contactModal"
                                                        class="btn mb-0 transition-3d-hover" style="color: #e40202">
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

                        {{ $products->appends(array_filter(request()->query()))->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/nouislider.min.js"></script>
    <script src="/assets/js/wNumb.min.js"></script>
    <script>
        let price_min = {{ request()->price_min ?? 0 }}
        let price_max = {{ request()->price_max ?? 100000000 }}

        var t = document.getElementById("priceRange");
        noUiSlider.create(t, {
            connect: true,
            behaviour: "tap",
            start: [price_min, price_max],
            range: {
                'min': [0],
                'max': [100000000]
            },
            pips: {
                format: wNumb({
                    decimals: 0,
                    thousand: ".",
                    suffix: " đ"
                })
            }
        });
        var e = document.getElementById("priceRange-value");

        var vndFormatter = wNumb({
            decimals: 0,
            thousand: ".",
            suffix: " đ"
        });

        t.noUiSlider.on("update", function(values) {
            var formatted = values.map(function(val) {
                return vndFormatter.to(parseFloat(val));
            });
            e.innerHTML = formatted.join(" - ");
        });

        t.noUiSlider.on("change", function(values) {
            updatePriceFilter(values);
        });

        function updatePriceFilter(values) {
            var minPrice = values[0];
            var maxPrice = values[1];

            var url = new URL(window.location.href);

            var params = new URLSearchParams(window.location.search);

            params.set('price_min', minPrice);
            params.set('price_max', maxPrice);

            url.search = params.toString();

            window.location.href = url;
        }

        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                document.getElementById('filterForm').submit();
            });
        });
    </script>
    <!-- Breadcrumb Section Start -->
    {{-- <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Đi chợ tại nhà</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                @if (request('category_l1') || request('category'))
                                    <li class="breadcrumb-item"> <a  href="{{ route('product.index') }}">Đi chợ tại nhà</a></li>
                                    <li class="breadcrumb-item active">{{ request('category_l1') }}{{ request('category') }}</li>
                                @else
                                    <li class="breadcrumb-item active">Đi chợ tại nhà</li>

                                @endif
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wow fadeInUp">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="slider-7_1 no-space shop-box no-arrow">

                        @foreach ($categories->where('level', 1) as $category)
                            <div>
                                <div class="shop-category-box">
                                    <a href="{{ route('product.index', array_merge(request()->query(), ['category_l1' => $category->name])) }}">
                                        <div class="shop-category-image">
                                            <img src="{{ $category->icon }}" class="blur-up lazyload" alt="">
                                        </div>
                                        <div class="category-box-name">
                                            <h6>{{ $category->name }}</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-custom-3 wow fadeInUp">
                    <div class="left-box">
                        <div class="shop-left-sidebar">
                            <div class="back-button">
                                <h3><i class="fa-solid fa-arrow-left"></i> Back</h3>
                            </div>

                            <div class="accordion custom-accordion" id="accordionExample">
                                <form action="{{route('product.index')}}" method="GET">
                                    <div class="form-floating theme-form-floating-2 search-box">
                                        <input type="search" class="form-control" name="search"
                                            placeholder="Search .." value="{{request('search')}}">
                                        <label for="search">Tìm kiếm</label>
                                    </div>
                                    @foreach (request()->except('search', 'page') as $key => $value)
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endforeach
                                </form>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne">
                                            <span>Danh mục</span>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            

                                            <ul class="category-list custom-padding custom-height">
                                                @foreach ($categories->where('level', 2) as $category)
                                                    <li>
                                                        <div class="form-check ps-0 m-0 category-list-box">
                                                            <input class="checkbox_animated" type="checkbox" id="fruit">
                                                            <label class="form-check-label" for="fruit">
                                                                <span class="name">{{ $category->name }}</span>
                                                                <span
                                                                    class="number">({{ $category->products->count() }})</span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>


                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree">
                                            <span>Price</span>
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <div class="range-slider">
                                                <input type="text" class="js-range-slider" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingSix">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseSix">
                                            <span>Đánh giá</span>
                                        </button>
                                    </h2>
                                    <div id="collapseSix" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <ul class="category-list custom-padding">
                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox">
                                                        <div class="form-check-label">
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
                                                                    <i data-feather="star" class="fill"></i>
                                                                </li>
                                                            </ul>
                                                            <span class="text-content">(5 Sao)</span>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox">
                                                        <div class="form-check-label">
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
                                                            <span class="text-content">(4 Sao)</span>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox">
                                                        <div class="form-check-label">
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
                                                                    <i data-feather="star"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"></i>
                                                                </li>
                                                            </ul>
                                                            <span class="text-content">(3 Sao)</span>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox">
                                                        <div class="form-check-label">
                                                            <ul class="rating">
                                                                <li>
                                                                    <i data-feather="star" class="fill"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star" class="fill"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"></i>
                                                                </li>
                                                            </ul>
                                                            <span class="text-content">(2 Sao)</span>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox">
                                                        <div class="form-check-label">
                                                            <ul class="rating">
                                                                <li>
                                                                    <i data-feather="star" class="fill"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"></i>
                                                                </li>
                                                                <li>
                                                                    <i data-feather="star"></i>
                                                                </li>
                                                            </ul>
                                                            <span class="text-content">(1 Sao)</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                            <span>Giảm giá</span>
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <ul class="category-list custom-padding">
                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox"
                                                            id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <span class="name">upto 5%</span>
                                                            <span class="number">(06)</span>
                                                        </label>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox"
                                                            id="flexCheckDefault1">
                                                        <label class="form-check-label" for="flexCheckDefault1">
                                                            <span class="name">5% - 10%</span>
                                                            <span class="number">(08)</span>
                                                        </label>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox"
                                                            id="flexCheckDefault2">
                                                        <label class="form-check-label" for="flexCheckDefault2">
                                                            <span class="name">10% - 15%</span>
                                                            <span class="number">(10)</span>
                                                        </label>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox"
                                                            id="flexCheckDefault3">
                                                        <label class="form-check-label" for="flexCheckDefault3">
                                                            <span class="name">15% - 25%</span>
                                                            <span class="number">(14)</span>
                                                        </label>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox"
                                                            id="flexCheckDefault4">
                                                        <label class="form-check-label" for="flexCheckDefault4">
                                                            <span class="name">More than 25%</span>
                                                            <span class="number">(13)</span>
                                                        </label>
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

                <div class="col-custom- wow fadeInUp">
                    <div class="show-button">
                        <div class="filter-button-group mt-0">
                            <div class="filter-button d-inline-block d-lg-none">
                                <a><i class="fa-solid fa-filter"></i> Filter Menu</a>
                            </div>
                        </div>

                        <div class="top-filter-menu">
                            <div class="grid-option d-none d-md-block">
                                <ul>
                                    <li class="three-grid">
                                        <a href="javascript:void(0)">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/grid-3.svg"
                                                class="blur-up lazyload" alt="">
                                        </a>
                                    </li>
                                    <li class="grid-btn d-xxl-inline-block d-none active">
                                        <a href="javascript:void(0)">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/grid-4.svg"
                                                class="blur-up lazyload d-lg-inline-block d-none" alt="">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/grid.svg"
                                                class="blur-up lazyload img-fluid d-lg-none d-inline-block"
                                                alt="">
                                        </a>
                                    </li>
                                    <li class="list-btn">
                                        <a href="javascript:void(0)">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/list.svg"
                                                class="blur-up lazyload" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div
                        class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">

                        @php
                            $timeIn = 0;
                        @endphp
                        @forelse ($products as $it)
                            <form class="form-add-to-cart" method="post">
                                <input type="text" name="product_id" hidden value="{{ $it->id }}">
                                <div>
                                    <div class="product-box-3 h-100 wow fadeInUp {{ $timeIn . 's' }}">
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
                                                <span class="span-name">{{ $it->category?->name }}</span>
                                                <a href="{{ route('product.detail', $it->id) }}">
                                                    <h5 class="name">{{ $it->name }}</h5>
                                                </a>
                                                <p class="text-content mt-1 mb-2 product-content">
                                                    {{ $it->short_description }}
                                                </p>
                                                <div class="product-rating mt-sm-2 mt-1">
                                                    @php
                                                        $rating =
                                                            $it->reviews->count() > 0
                                                                ? $it->reviews->sum('rating') / $it->reviews->count()
                                                                : 0;
                                                    @endphp
                                                    <ul class="rating me-1">

                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <li>
                                                                <i data-feather="star"
                                                                    class="{{ $i <= $rating ? 'fill' : '' }}"></i>
                                                            </li>
                                                        @endfor
                                                    </ul>
                                                    <h6 class="theme-color">
                                                        {{ $it->stock_quantity > 0 ? ' Còn Hàng' : ' Hết Hàng' }}
                                                    </h6>
                                                </div>
                                                <h5 class="price"><span
                                                        class="theme-color">{{ $it->has_sale ? number_format($it->sale_price, 0, '.', ',') : number_format($it->price, 0, '.', ',') }}
                                                        đ</span>
                                                    <del>{{ $it->has_sale ? number_format($it->price, 0, '.', ',') . ' đ' : '' }}</del>
                                                </h5>
                                                <div class="add-to-cart-box bg-white">
                                                    <div class="{{ $it->stock_quantity < 0 ? 'out-stock' : '' }}">
                                                        <button class="btn btn-add-cart addcart-button" type="submit">Thêm vào giỏ
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @php
                                $timeIn += 0.05;
                            @endphp
                        @empty
                            <p class="w-100 text-center">Không có sản phẩm nào </p>
                        @endforelse


                    </div>

                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section> --}}
@endsection

@section('scripts')
    {{-- <script>
        const min = {{ $minPrice }};
        const max = {{ $maxPrice }};
        $('#price-range').slider({
            range: true,
            min: 10000,
            max: 10000000,
            values: [min, max],
            slide: function(event, ui) {
                $('#price-amount').val(ui.values[0].toLocaleString('vi-VN') + 'đ - ' + ui.values[1]
                    .toLocaleString('vi-VN') + 'đ');
            }
        });

        $('#price-amount').val($('#price-range').slider('values', 0).toLocaleString('vi-VN') + 'đ - ' +
            $('#price-range').slider('values', 1).toLocaleString('vi-VN') + 'đ');

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
    </script> --}}
@endsection
