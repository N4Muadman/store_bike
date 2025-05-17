@extends('layout')
@section('title', 'Tin Tức')

@section('content')
    <h1 class="visually-hidden">Cập Nhật Tin Tức Xe Đạp Nhật Bãi Mỗi Ngày</h1>
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
                            <li>Tin Tức</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog grid section -->
    <section class="blog py-5">
        <div class="container">
            <div class="row animate__animated wow animate__fadeInUp">
                @forelse ($news as $it)
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="blog-card row g-0">
                            <a href="{{ route('blog.detail', $it->slug) }}">
                                <div class="overflow-hidden position-relative col-12 theme-border-radius">
                                    <figure class="mb-0 img-effect">
                                        <img src="{{ $it->image }}" class="img-fluid" alt="news articles">
                                    </figure>
                                </div>
                            </a>
                            <div class="col-12 mt-3">
                                <a href="#"><span class="cat fw-bold fs-6">{{ $it->created_at }}</span></a>
                                <a class="font-small fw-bold theme-text-accent-one">
                                    <i class="bi bi-person ms-2 theme-text-primary"></i>
                                    <span>{{ $it->user?->name }}</span>
                                </a>
                                <a href="{{ route('blog.detail', $it->slug) }}"
                                    class="fs-4 text-black d-block fw-bold my-3 text">{{ $it->title }}</a>
                                <div class="d-flex">
                                    <a href="{{ route('blog.detail', $it->slug) }}" class="font-small fw-bold link-more">Xem
                                        thêm<i class="bi bi-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="w-100 text-center">Không có bài viết nào</p>
                @endforelse
            </div>


            <!-- pagination -->
            <div class="row mt-5">
                <div class="col-12">
                    {{ $news->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
@endsection
