@extends('admin.layout.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Thống kê</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Quản lý bài viết</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2">Danh sách bài viết</h2>
                        <button data-bs-toggle="modal" data-bs-target="#add-post"
                            class="btn btn-light-primary d-flex align-items-center gap-2"><i class="ti ti-plus"></i> Thêm
                            bài viết</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.posts.index') }}" method="get">
        <div class="row align-items-center mb-3">
            <div class="col-12 col-md-3">
                <input type="text" class="form-control" name="title" placeholder="Tìm kiếm theo tiêu đề"
                    value="{{ request('title') }}">
            </div>

            <div class="col-3">
                <button type="submit" class="btn btn-info">Tìm kiếm</button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-12">
            <div class="card table-card">
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table class="table table-hover text-center table-fixed" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tiêu đề</th>
                                    <th>Ảnh</th>
                                    <th>Mô tả ngắn</th>
                                    <th>Danh mục</th>
                                    <th>Tác giả</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $it)
                                    <tr>
                                        <td>{{ $it->id }}</td>
                                        <td>{{ $it->title }}</td>
                                        <td><img src="{{ $it->image }}" width="60px" alt=""></td>
                                        <td>{{ $it->short_content }}</td>
                                        <td>
                                            @php
                                                $categories = json_decode($it->sub_categories, true);
                                            @endphp

                                            @foreach ($categories as $ca)
                                                <button class="btn btn-info">{{ $ca }}</button>
                                            @endforeach
                                        </td>
                                        <td>{{ $it->user ? $it->user->name : $it->user_id }}</td>
                                        <td>
                                            <a href="{{ route('blog.detail', $it->slug) }}"
                                                class="avtar avtar-details avtar-xs btn-link-secondary"
                                                title="XEM CHI TIẾT">
                                                <i class="ti ti-eye f-20"></i>
                                            </a>
                                            <a href="#"class="avtar avtar-edit avtar-xs btn-link-secondary"
                                                data-id="{{ $it->id }}" title="CẬP NHẬT">
                                                <i class="ti ti-edit f-20"></i>
                                            </a>
                                            <a href="#" class="avtar avtar-delete avtar-xs btn-link-secondary"
                                                data-title="{{ $it->title }}" data-id="{{ $it->id }}"
                                                title="XÓA BÀI VIẾT">
                                                <i class="ti ti-trash f-20"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <p class="text-center">Không có bài viết nào</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="ps-5 pe-5">
                            {{ $posts->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-post" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Thêm mới bài viết</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.posts.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="mb-3 mb-0">
                                                    <label class="form-label">Tiêu đề</label>
                                                    <input type="text" class="form-control" name="title"
                                                        placeholder="Tiều đề bài viết" required>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="border rounded p-3 h-100">
                                                    <div
                                                        class="d-flex flex-column align-items-center justify-content-center mb-2">
                                                        <p class="mb-0 f-16">Ảnh</p>
                                                        <label for="file-upload" class="custom-file-upload">
                                                            <i class="fas fa-upload"></i>
                                                            Thêm ảnh
                                                        </label>
                                                        <input type="file" id="file-upload" name="image"
                                                            style="display: none" accept="image/*" required>
                                                        <div class="text-center mt-4" id="product-images">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3 mb-0">
                                                    <label class="form-label">Danh mục</label>
                                                    <input name="categories" class="form-control" id="category_add"
                                                        placeholder="Nhập danh mục và nhấn Enter" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3 mb-0"><label class="form-label">Nội dung ngắn</label>
                                                    <textarea class="form-control" name="short_content" rows="3" placeholder="Nội dung ngắn" required></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3 mb-0"><label class="form-label">Nội dung chính</label>
                                                    <textarea class="form-control content" name="content" id="content" rows="3" placeholder="Nội dung chính"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row align-items-end justify-content-end g-3">
                                                    <div class="col-sm-auto btn-page">
                                                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="dialog-edit"></div>
    <div id="dialog-delete"></div>
    <script src="https://cdn.tiny.cloud/1/qf4pnfpic603nbrs0wu0r3cyaadnairp5ngpr08muctqj041/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script>
        function tiny() {
            tinymce.init({
                selector: '.content',
                advcode_inline: true,
                menubar: false,
                plugins: 'searchreplace autolink directionality visualblocks visualchars image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap linkchecker emoticons autosave fullscreen',
                toolbar: "undo redo print spellcheckdialog formatpainter | blocks fontfamily fontsize | bold italic underline forecolor backcolor | link image | alignleft aligncenter alignright alignjustify | code",
                height: '450px'
            });
        }

        function tagify(id) {
            input = document.getElementById(id);
            var tagify = new Tagify(input, {
                delimiters: ",|Enter",
                maxTags: 10,
                placeholder: "Nhập danh mục và nhấn Enter",
                whitelist: [],
                dropdown: {
                    maxItems: 5,
                    enabled: 1,
                    closeOnSelect: true
                }
            });
        }


        document.querySelectorAll('.avtar-edit').forEach((element) => {
            element.addEventListener('click', async () => {
                const id = element.dataset.id;

                if (id) {
                    const response = await fetch('{{ route('admin.posts.edit', ':id') }}'.replace(
                        ':id', id), {
                        method: "GET",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const data = await response.text();
                    if (!response.ok) {
                        alert('Có lỗi xảy ra', data.message);
                        return;
                    }
                    document.getElementById('dialog-edit').innerHTML = data;
                    await tiny();
                    await tagify('categories_edit');
                    await uploadFileEdit();
                    const modal = new bootstrap.Modal(document.getElementById('edit-post'));
                    modal.show();

                }
            })
        })

        tiny();
        tagify('category_add');

        function uploadFileEdit() {
            document.getElementById('file-upload-edit').addEventListener('change', function(event) {
                var files = event.target.files;
                var fileInfo = document.getElementById('file-info-edit');

                if (files.length > 0) {
                    if (files.length === 1) {
                        fileInfo.textContent = "Bạn đã chọn 1 tệp: " + files[0].name;
                    } else {
                        fileInfo.textContent = "Bạn đã chọn " + files.length + " tệp tin.";
                    }
                } else {
                    fileInfo.textContent = "Chưa chọn tệp nào.";
                }
            });
        }

        document.querySelectorAll('.avtar-delete').forEach((element) => {
            element.addEventListener('click', async () => {
                const id = element.dataset.id;
                const title = element.dataset.title;

                if (id) {
                    document.getElementById('dialog-delete').innerHTML = `<div class="modal fade" id="delete-post" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="orderModalLabel">Xác nhận xóa</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p>Bạn có muốn xóa bài viết: <strong>${title}</strong> không?</p>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                                                        <form action="{{ route('admin.posts.destroy', ':id') }}" method="post">
                                                                                            @csrf
                                                                                            @method('delete')
                                                                                            <button type="submit" class="btn btn-info">Xóa</button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>`.replace(':id', id);
                    const modal = new bootstrap.Modal(document.getElementById('delete-post'));
                    modal.show();
                }
            });
        });

        document.getElementById('file-upload').addEventListener('change', function(event) {
            const file = event.target.files[0];

            const previewContainer = document.getElementById('product-images');
            previewContainer.innerHTML = '';

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'ảnh sản phẩm';
                    img.style.width = '100%';
                    img.style.border = '1px solid rgb(0, 247, 255)';
                    img.style.borderRadius = '6px';

                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
