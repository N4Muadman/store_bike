@extends('admin.layout.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Thống kê</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">banner trang chủ</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2">Danh sách banner</h2>
                        <button data-bs-toggle="modal" data-bs-target="#add-banner"
                            class="btn btn-light-primary d-flex align-items-center gap-2"><i class="ti ti-plus"></i> Thêm
                            banner</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card table-card">
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table class="table table-hover text-center table-fixed" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ảnh</th>
                                    <th>Trạng thái</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($banners as $it)
                                    <tr>
                                        <td>{{ $it->id }}</td>
                                        <td><img src="{{ $it->image_path }}" width=100% alt="banner"></td>
                                        <td>{!! $it->status_label !!}</td>
                                        <td>
                                            <a href="#!"class="avtar avtar-edit avtar-xs btn-link-secondary"
                                                data-id="{{ $it->id }}" title="CẬP NHẬT">
                                                <i class="ti ti-edit f-20"></i>
                                            </a>
                                            <a href="#!" class="avtar avtar-delete avtar-xs btn-link-secondary"
                                                data-title="{{ $it->title }}" data-id="{{ $it->id }}"
                                                title="Xóa banner">
                                                <i class="ti ti-trash f-20"></i>
                                            </a>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <p class="text-center">Không có banner nào</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="dialog-edit"></div>
    <div id="dialog-delete"></div>
    <div class="modal fade" id="add-banner" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Thêm mới banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.banner.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-xl-12">
                            <div class="border rounded p-3 h-100 mb-3">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p class="mb-0 f-18">Ảnh</p>
                                    <label for="file-upload" class="custom-file-upload">
                                        <i class="fas fa-upload"></i>
                                        Thêm ảnh
                                    </label>
                                    <input type="file" id="file-upload" name="image" style="display: none"
                                        accept="image/*">
                                    @error('image')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>
                                <div class="text-center" id="banner-image">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Trạng thái</label>
                            <select name="status" class="form-select" id="">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-info">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.tiny.cloud/1/qf4pnfpic603nbrs0wu0r3cyaadnairp5ngpr08muctqj041/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr"></script>
    <script>
        document.querySelectorAll('.avtar-edit').forEach((element) => {
            element.addEventListener('click', async () => {
                const id = element.dataset.id;
                if (id) {
                    const response = await fetch('{{ route('admin.banner.edit', ':id') }}'.replace(
                        ':id', id), {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        }
                    });
                    const data = await response.text();

                    if (!response.ok) {
                        alert('Có lỗi xảy ra');
                        return;
                    }

                    document.getElementById('dialog-edit').innerHTML = data;

                    const dialog = new bootstrap.Modal(document.getElementById('edit-banner'));
                    dialog.show();

                    uploadFileEdit();
                }
            })
        })
        document.querySelectorAll('.avtar-delete').forEach((element) => {
            element.addEventListener('click', async () => {
                const id = element.dataset.id;
                const title = element.dataset.title;
                if (id) {
                    document.getElementById('dialog-delete').innerHTML = `<div class="modal fade" id="delete-banner" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-xs">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="orderModalLabel">Xác nhận xóa banner</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p>Bạn có muốn xóa banner này không?</p>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                                                        <form method="post" action="{{ route('admin.banner.destroy', ':id') }}">
                                                                                            @csrf
                                                                                            @method('delete')
                                                                                            <button type="submit" class="btn btn-info">Xóa</button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>`.replace(':id', id);
                    const modal = new bootstrap.Modal(document.getElementById('delete-banner'));
                    modal.show();
                }
            })
        })

        document.getElementById('file-upload').addEventListener('change', function(event) {

            const file = event.target.files[0];
            const previewContainer = document.getElementById('banner-image');

            if (!previewContainer) return;
            previewContainer.innerHTML = '';

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'ảnh sản phẩm';
                    img.style.width = '50%';
                    img.style.border = '1px solid rgb(0, 247, 255)';
                    img.style.borderRadius = '6px';

                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            }

        });

        function uploadFileEdit() {
            const fileUpload = document.getElementById('file-upload-edit');
            if (!fileUpload) return;

            fileUpload.addEventListener('change', function(event) {
                const file = event.target.files[0];
                const previewContainer = document.getElementById('banner-image-edit');

                if (!previewContainer) return;
                previewContainer.innerHTML = '';

                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = 'ảnh sản phẩm';
                        img.style.width = '50%';
                        img.style.border = '1px solid rgb(0, 247, 255)';
                        img.style.borderRadius = '6px';

                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>
@endsection
