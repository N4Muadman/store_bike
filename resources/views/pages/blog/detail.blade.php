@extends('layout')
@section('title', $blog->title)
@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Chi tiết tin tức</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('blogs')}}">Tin tức</a></li>
                                <li class="breadcrumb-item active">Chi tiết tin tức</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Details Section Start -->
    <section class="blog-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-3 col-xl-4 col-lg-5 d-lg-block d-none">
                    <div class="left-sidebar-box">
                        <div class="left-search-box">
                            <form action="{{route('blogs')}}" method="get">
                                <div class="search-box">
                                    <input type="search" name="search" class="form-control" id="exampleFormControlInput4"
                                        placeholder="Tìm kiếm bài viết....">
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
                                            @forelse ($recentBlogs as $it)
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

                <div class="col-xxl-9 col-xl-8 col-lg-7 ratio_50">
                    <div class="blog-detail-image rounded-3 mb-4">
                        <img src="{{$blog->image}}" class="bg-img blur-up lazyload" alt="">
                        <div class="blog-image-contain">
                            <ul class="contain-list">
                                @foreach (json_decode($blog->sub_categories) as $category)
                                    <li>{{$category}}</li>
                                @endforeach
                            </ul>
                            <h2>{{ $blog->title }}</h2>
                            <ul class="contain-comment-list">
                                <li>
                                    <div class="user-list">
                                        <i data-feather="user"></i>
                                        <span>{{ $blog->user?->name }}</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="user-list">
                                        <i data-feather="calendar"></i>
                                        <span>{{ $blog->created_at }}</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="user-list">
                                        <i data-feather="message-square"></i>
                                        <span>{{$blog->comments->count()}} Bình luận</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="blog-detail-contain">
                        {!! $blog->content !!}
                    </div>

                    <div class="comment-box overflow-hidden">
                        <div class="leave-title">
                            <h3>Bình luận</h3>
                        </div>

                        <div class="user-comment-box">
                            <ul>
                                @forelse ($blog->comments as $comment)
                                <li>
                                    <div class="user-box border-color">
                                        <div class="user-image">
                                            <img src="../assets/images/inner-page/user/1.jpg"
                                                class="img-fluid blur-up lazyload" alt="">
                                            <div class="user-name">
                                                <h6>{{ $comment->created_at }}</h6>
                                                <h5 class="text-content">{{ $comment->user ? $comment->user->name : 'Ẩn danh' }}</h5>
                                            </div>
                                        </div>

                                        <div class="user-contain">
                                            <p>{{$comment->content}}</p>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                    <p class="w-100 text-center">Không có bình luận nào</p>
                                @endforelse

                            </ul>
                        </div>
                    </div>

                    <div class="leave-box">
                        <div class="leave-title mt-0">
                            <h3>Để lại bình luận</h3>
                        </div>

                        <div class="leave-comment">
                            <div class="comment-notes">
                                <p class="text-content mb-4">Địa chỉ email của bạn sẽ không được công bố. Các trường bắt buộc được đánh dấu</p>
                            </div>
                            <form action="{{route('postComment')}}" method="post">
                                @csrf
                                <input type="text" name="blog_id" value="{{$blog->id}}" hidden>
                                <div class="row g-3">
                                    <div class="col-xxl-4 col-lg-12 col-sm-6">
                                        <div class="blog-input">
                                            <input type="text" name="full_name" class="form-control" id="exampleFormControlInput1"
                                                placeholder="Họ và tên">
                                        </div>
                                    </div>
    
                                    <div class="col-xxl-4 col-lg-12 col-sm-6">
                                        <div class="blog-input">
                                            <input type="email" name="email" class="form-control" id="exampleFormControlInput2"
                                                placeholder="Địa chỉ Email">
                                        </div>
                                    </div>
    
                                    <div class="col-12">
                                        <div class="blog-input">
                                            <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="4"
                                                placeholder="Bình luận"></textarea>
                                        </div>
                                    </div>
                                </div>
    
                                <button class="btn btn-animation ms-xxl-auto mt-xxl-0 mt-3 btn-md fw-bold">Đăng bình luận</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

@endsection
