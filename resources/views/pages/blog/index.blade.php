@extends('layout')
@section('title', 'Tin Tức')

@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Tin Tức</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Tin Tức</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Start -->
    <section class="blog-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-4">
                <div class="col-xxl-9 col-xl-8 col-lg-7 order-lg-2">
                    <div class="row g-4 ratio_65">
                        @php
                            $timeShow = 0;
                        @endphp
                        @forelse ($news as $it)
                            <div class="col-xxl-4 col-sm-6">
                                <div class="blog-box wow fadeInUp" data-wow-delay="{{ $timeShow }}s">
                                    <div class="blog-image">
                                        <a href="{{ route('blog.detail', $it->slug) }}">
                                            <img src="{{ $it->image }}" class="bg-img blur-up lazyload" alt="">
                                        </a>
                                    </div>

                                    <div class="blog-contain">
                                        <div class="blog-label">
                                            <span class="time"><i data-feather="clock"></i>
                                                <span>{{ $it->created_at }}</span></span>
                                            <span class="super"><i data-feather="user"></i>
                                                <span>{{ $it->user?->name }}</span></span>
                                        </div>
                                        <a href="{{ route('blog.detail', $it->slug) }}">
                                            <h3>{{ $it->title }}</h3>
                                        </a>
                                        <button onclick="location.href = '{{ route('blog.detail', $it->slug) }}';"
                                            class="blog-button">Xem thêm
                                            <i class="fa-solid fa-right-long"></i></button>
                                    </div>
                                </div>
                            </div>

                            @php
                                $timeShow += 0.05;
                            @endphp
                        @empty
                            <p class="w-100 text-center">Không có bài viết nào</p>
                        @endforelse
                    </div>

                    {{ $news->links('pagination::bootstrap-5') }}
                </div>

                <div class="col-xxl-3 col-xl-4 col-lg-5 order-lg-1">
                    <div class="left-sidebar-box wow fadeInUp">
                        <div class="left-search-box">
                            <form action="{{ route('blogs') }}" method="get">
                                <div class="search-box">
                                    <input type="search" name="search" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Tìm kiếm....">
                                </div>
                            </form>
                        </div>

                        <div class="accordion left-accordion-box" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne">
                                        Bài viết gần đây
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                    <div class="accordion-body pt-0">
                                        <div class="recent-post-box">
                                            @forelse ($news->take(4) as $it)
                                            <div class="recent-box">
                                                <a href="{{route('blog.detail', $it->slug)}}" class="recent-image">
                                                    <img src="{{$it->image}}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>

                                                <div class="recent-detail">
                                                    <a href="{{route('blog.detail', $it->slug)}}">
                                                        <h5 class="recent-name">{{$it->title}}</h5>
                                                    </a>
                                                    <h6>{{$it->created_at}} <i data-feather="thumbs-up"></i></h6>
                                                </div>
                                            </div>
                                            @empty
                                                <p class="w-100 text-center">Không có bài viết nào</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseFour">Sản phẩm thịnh hành</button>
                                </h2>
                                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse collapse show">
                                    <div class="accordion-body">
                                        <ul class="product-list product-list-2 border-0 p-0">
                                            @forelse($trendingProduct as $product)
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
                                                                <span>
                                                                    {{ $product->stock_quantity > 0 ? 'Còn Hàng' : 'Hết Hàng' }}
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
