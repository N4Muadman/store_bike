@extends('layout')

@section('content')
<div class="breadcrumb-area section-space--breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="breadcrumb-wrapper">
                    <hp class="page-title">Chi tiết dự án</hp>
                    <ul class="breadcrumb-list">
                        <li><a href="index.html">Trang chủ</a></li>
                        <li class="active">Chi tiết dự án</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content-wrapper news-detail">
    <div class="blog-page-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2">
                    <div class="blog-sidebar-wrapper">

                        <div class="single-sidebar-widget single-sidebar-widget--extra-space">
                            <div class="heading heading-fixed" id="heading">
                                <p class="text-center m-3 fs-4">Nội dung chính</p>
                                <div class="heading-content" id="toc"></div>
                            </div>
                        </div>

                        <div class="single-sidebar-widget">
                            <p class="single-sidebar-widget__title">Dự án gần đây</p>
                            <ul class="single-sidebar-widget__dropdown single-sidebar-widget__dropdown--extra-height">
                                @forelse ($recentProjects as $recentProject)
                                    <li><a href="{{ route('project.detail', $recentProject->slug) }}">{{ $recentProject->title }}</a></li>
                                @empty
                                    <p>Không có dự án nào</p>
                                @endforelse
                            </ul>
                        </div>


                        <div class="single-sidebar-widget">
                            <p class="single-sidebar-widget__title">Danh mục</p>
                            <ul class="single-sidebar-widget__dropdown">
                                @php
                                    $categories = json_decode($project->sub_categories, true);
                                @endphp
                                @foreach ($categories as $ct)
                                    <li><a href="#">{{ $ct }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 order-1">
                    <div class="blog-single-post-details-wrapper news-detail-content">

                        <h1 class="post-title">{{ $project->title }}</h1>
                        {{-- <p class="post-meta">Nguời đăng <a href="#" class="post-author">{{ $project->user->name }}</a> <span class="separator">|</span> <a href="#">{{ $project->created_at }}</a></p> --}}

                        <div class="post-thumbnail">
                            <img src="{{ $project->image }}" width="100%" class="img-fluid" alt="">
                        </div>

                        <div class="post-text-content">
                            <p>{!! $project->content !!}</p>
                        </div>

                        <div class="post-share-section">
                            <span>Chia sẻ:</span>
                            <ul class="post-social-icons">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        initTOC(); // Gọi hàm tạo mục lục sau khi trang được tải

        function initTOC() {
            // Lấy tất cả các heading trong bài viết
            const headings = document.querySelectorAll('.news-detail-content h1, .news-detail-content h2, .news-detail-content h3, .news-detail-content h4, .news-detail-content h5, .news-detail-content h6');
            if (headings.length === 0) return;

            // Khai bào nơi mà TOC sẽ được chèn vào
            const tocContainer = document.querySelector('#toc');

            // Xác định cấp độ bắt đầu của TOC
            const startingLevel = headings[0].tagName[1];

            // Tạo TOC rỗng
            const toc = document.createElement('ul');

            // Theo dõi các cấp độ heading trước đó
            const prevLevels = [0, 0, 0, 0, 0, 0];

            // Lặp qua từng heading và thêm chúng vào TOC
            headings.forEach((heading, index) => {
                const level = parseInt(heading.tagName[1]);

                // Tăng các cấp độ trước đó lên đến cấp độ hiện tại
                prevLevels[level - 1]++;
                for (let j = level; j < prevLevels.length; j++) {
                    prevLevels[j] = 0;
                }

                // Tạo số mục cho mục đó
                const sectionNumber = prevLevels.slice(startingLevel - 1, level).join('.').replace(/\.0/g, "");

                // Tạo ID mới và gán vào heading
                const newHeadingId = `${heading.textContent.toLowerCase().replace(/ /g, '-')}`;
                heading.id = newHeadingId;

                // Tạo liên kết mục cho heading
                const anchor = document.createElement('a');
                anchor.setAttribute('href', `#${newHeadingId}`);
                anchor.textContent = heading.textContent;

                // Tạo thẻ <li> để thêm vào TOC
                const listItem = document.createElement('li');
                listItem.textContent = sectionNumber + ' ';
                listItem.appendChild(anchor);

                // Thêm CSS class cho từng mục lục
                const className = `toc-${heading.tagName.toLowerCase()}`;
                listItem.classList.add('toc-item', className);

                // Bỏ thẻ <li> vừa tạo vào TOC
                toc.appendChild(listItem);
            });

            // Thêm TOC vào DOM
            tocContainer.innerHTML = '';
            tocContainer.appendChild(toc);

            // Thêm event listener cho window object để lắng nghe sự kiện scroll
            window.addEventListener('scroll', function () {
                let scroll = window.scrollY;
                let height = window.innerHeight;
                let offset = 200;

                headings.forEach(function (heading, index) {
                    let target = document.querySelector(`#toc li:nth-of-type(${index + 1}) > a`);
                    let pos = heading.getBoundingClientRect().top + scroll;

                    if (scroll > pos - height + offset) {
                        if (headings[index + 1] !== undefined) {
                            let next_pos = headings[index + 1].getBoundingClientRect().top + scroll;
                            if (scroll > next_pos - height + offset) {
                                target.classList.remove('heading-active');
                            } else {
                                target.classList.add('heading-active');
                            }
                        } else {
                            target.classList.add('heading-active');
                        }
                    } else {
                        target.classList.remove('heading-active');
                    }
                });
            });
        }
    });
</script>
@endsection
