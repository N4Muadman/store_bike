@extends('layout')
@section('title', $blog->title)
@section('content')
    <!-- Breadcrumb Section Start -->
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
                            <li><a href="{{ url()->previous() }}">Tin Tức</a></li>
                            <li>Chi tiết tin tức</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->
    <section class="blog pb-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <!-- blog section -->
                <div class="col-12 col-lg-12 mb-4">
                    <div class="blog-card row g-0">
                        <div class="text-center">
                            @foreach (json_decode($blog->sub_categories) as $category)
                                <a href="#"><span class="cat fw-bold fs-6">{{ $category }}</span></a>
                            @endforeach
                        </div>
                        <h1 class="fs-3 fw-bold my-3 text-center text">{{ $blog->title }}</h1>
                        <div class="mt-1 mb-5 d-flex align-items-center justify-content-center">
                            <span class="me-3">
                                {{-- <img alt="avatar" src="/assets/images/avatar/01.png" class="img-fluid rounded-pill"
                                    height="30" width="30"> --}}
                                <span class="ms-3">Người đăng: </span><a href="#">{{ $blog->user?->name }}</a>
                            </span>

                            <i class="bi bi-dot theme-text-accent-two"></i>
                            <a href="#" class="theme-text-accent-two">{{ $blog->comments->count() }} Bình luận</a>
                        </div>
                        <div class="overflow-hidden position-relative col-12 theme-border-radius">
                            <figure class="mb-0 text-center">
                                <img src="{{ $blog->image }}" class="img-fluid" alt="news articles">
                            </figure>

                        </div>
                        <div class="col-12 mt-3">
                            <div class="mt-4 post-wrap post-wrap-center">
                                <p class="fw-bold"><i>{{ $blog->short_content }}</i></p>
                                {!! $blog->content !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="post-wrap-center">
                    <div class="col-12">
                        <!-- related post section -->
                        <div class="row mt-5">
                            <div class="col-12">
                                <h2 class="fs-1 font-black text-start theme-text-primary mb-3">Bài viết liên quan</h2>
                            </div>
                            <!-- related post carousel -->
                            <div class="row mt-3 carouselRelatedPost">
                                @forelse ($recentBlogs as $it)
                                    <div class="col-12 col-lg-6 mb-4">
                                        <div class="blog-card mx-2">
                                            <a href="{{ route('blog.detail', $it->slug) }}">
                                                <div class="overflow-hidden position-relative col-12 theme-border-radius">
                                                    <figure class="mb-0 img-effect">
                                                        <img src="{{ $it->image }}" class="img-fluid"
                                                            alt="news articles">
                                                    </figure>
                                                </div>
                                            </a>
                                            <div class="mt-3">
                                                <a href="#"><span
                                                        class="cat fw-bold fs-6">{{ $it->created_at }}</span></a>
                                                <a href="javascript:void(0)"
                                                    class="font-small fw-bold theme-text-accent-one">
                                                    <i class="bi bi-person ms-2 theme-text-primary"></i>
                                                    <span>{{ $it->user?->name }}</span>
                                                </a>
                                                <a href="{{ route('blog.detail', $it->slug) }}"
                                                    class="fs-4 d-block fw-bold my-3">{{ $it->title }}</a>
                                                <div class="d-flex">
                                                    <a href="{{ route('blog.detail', $it->slug) }}"
                                                        class="font-small fw-bold link-more">Đọc thêm<i
                                                            class="bi bi-arrow-right ms-2"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="w-100 text-center">Không có bài viết nào</p>
                                @endforelse
                            </div>
                        </div>
                        <!-- blog comment section -->
                        <div class="row">
                            <div class="col-12">
                                <!-- blog post comment -->
                                <div class="blog-details-comment">
                                    <h4>{{ $blog->comments->count() }} Bình luận</h4>

                                    @forelse ($blog->comments as $comment)
                                        <div class="comment-item">
                                            <div class="comment-item-pic">
                                                <img src="/assets/images/blog/details/comment-1.png" alt="">
                                            </div>
                                            <div class="comment-item-text">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <span>{{ $comment->created_at }}</span>
                                                        <h5>{{ $comment->user ? $comment->user->name : 'Ẩn danh' }}</h5>
                                                    </div>
                                                    <div>
                                                        {{-- <a href="#">Reply</a> --}}
                                                    </div>
                                                </div>
                                                <p>{{ $comment->content }}</p>
                                            </div>
                                        </div>

                                    @empty
                                        <p class="w-100 text-center">Không có bình luận nào</p>
                                    @endforelse

                                </div>
                            </div>
                        </div>
                        <!-- comment form section -->
                        <div class="row mt-5">
                            <div class="col-12">
                                <!-- blog post comment form -->
                                <div class="blog-details-form">
                                    <h4>Để lại bình luận</h4>
                                    <div class="comment-notes">
                                        <p class="text-content mb-4">Địa chỉ email của bạn sẽ không được công bố. Các trường
                                            bắt
                                            buộc được đánh dấu</p>
                                    </div>
                                    <form action="{{ route('postComment') }}" method="post">
                                        @csrf
                                        <input type="text" name="blog_id" value="{{ $blog->id }}" hidden>
                                        <div class="row g-3">
                                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                                                <div class="blog-input">
                                                    <input type="text" name="full_name" class="form-control"
                                                        id="exampleFormControlInput1" placeholder="Họ và tên">
                                                </div>
                                            </div>

                                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                                                <div class="blog-input">
                                                    <input type="email" name="email" class="form-control"
                                                        id="exampleFormControlInput2" placeholder="Địa chỉ Email">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="blog-input">
                                                    <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="4"
                                                        placeholder="Bình luận"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="btn custom-btn-primary fw-bold button-effect transition-3d-hover px-4">
                                            Đăng bình luận</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
