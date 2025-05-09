@extends('admin.layout.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Thống kê</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Quản lý sản phẩm</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2">Danh sách sản phẩm</h2>
                        <button data-bs-toggle="modal" data-bs-target="#add-product"
                            class="btn btn-light-primary d-flex align-items-center gap-2"><i class="ti ti-plus"></i> Thêm
                            sản phẩm</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.products.index') }}" method="get">
        <div class="row align-items-center mb-3">
            <div class="col-12 col-md-3">
                <input type="text" class="form-control" name="name" placeholder="Tìm kiếm theo tên"
                    value="{{ request('name') }}">
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
                        <table class="table table-hover text-center" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Ảnh</th>
                                    <th>Giá bán</th>
                                    <th>Giá sau khi giảm</th>
                                    <th>Số lượng trong kho</th>
                                    <th>Đã bán</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td><img src="{{ $product->images->first()?->image_path }}"
                                                width="60px" alt="ảnh sp"></td>
                                        <td>{{ number_format($product->price, 0, '.', ',') }} đ</td>
                                        <td>
                                            {{ number_format($product->sale_price, 0, '.', ',') }} đ
                                        </td>
                                        <td>{{ $product->stock_quantity }}</td>
                                        <td>{{ $product->total_purchases }}</td>
                                        
                                        <td>
                                            <a href="{{ route('product.detail', $product->id) }}"
                                                class="avtar avtar-details avtar-xs btn-link-secondary"
                                                title="XEM CHI TIẾT">
                                                <i class="ti ti-eye f-20"></i>
                                            </a>
                                            <a href="{{ route('admin.products.edit', $product->id) }}"class="avtar avtar-change avtar-xs btn-link-secondary"
                                                data-id="{{ $product->id }}" title="CẬP NHẬT TRẠNG THÁI">
                                                <i class="ti ti-edit f-20"></i>
                                            </a>
                                            <a href="#" class="avtar avtar-delete avtar-xs btn-link-secondary"
                                                data-name="{{ $product->name }}" data-id="{{ $product->id }}"
                                                title="XÓA ĐƠN HÀNG">
                                                <i class="ti ti-trash f-20"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10">
                                            <p class="text-center">không có đơn hàng nào</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="ps-5 pe-5">
                            {{ $products->appends(array_filter(request()->query()))->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="dialog-delete"></div>
    <div class="modal fade" id="add-product" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Thêm mới sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.products.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-sm-6 col-xl-6">
                                                <div class="mb-3 mb-0">
                                                    <label class="form-label">Tên sản phẩm</label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Tên sản phẩm" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-6">
                                                <div class="mb-3 mb-0">
                                                    <label class="form-label">Giá bán sản phẩm</label>
                                                    <input type="text" name="price" class="form-control money"
                                                        placeholder="Giá sản phẩm" required>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="border rounded p-3 h-100">
                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                        <p class="mb-0 f-18">Ảnh</p>
                                                        <label for="file-upload" class="custom-file-upload">
                                                            <i class="fas fa-upload"></i>
                                                            Thêm ảnh
                                                        </label>
                                                        <input type="file" id="file-upload" name="images[]"
                                                            style="display: none" accept="image/*" multiple required>
                                                    </div>
                                                    <div class="d-flex" id="product-images">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-xl-4">
                                                <div class="mb-3 mb-0">
                                                    <label class="form-label">Số lượng trong kho</label>
                                                    <input type="text" name="stock_quantity" class="form-control"
                                                        placeholder="Số lượng trong kho" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-xl-4">
                                                <div class="mb-3 mb-0">
                                                    <label class="form-label">Danh mục</label>
                                                    <select name="category_id" class="form-select" id=""
                                                        required>
                                                        <option value="">Chọn danh mục</option>
                                                        @foreach ($categories as $it)
                                                            <option value="{{ $it->id }}">{{ $it->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-xl-4">
                                                <div class="mb-3 mb-0" >
                                                    <label class="form-label">Giá sau khi giảm</label>
                                                    <input type="text" class="form-control money"
                                                        placeholder="Giá sau khi giảm" name="sale_price">

                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <div class="mb-3 mb-0"><label class="form-label">Mô tả ngắn</label>
                                                    <div id="quill-editor-short-description" class="mb-3"
                                                        style="height: 250px;">
                                                    </div>
                                                    <textarea rows="3" class="mb-3 d-none" name="short_description" id="quill-editor-area-short-description">
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3 mb-0"><label class="form-label">Mô tả sản phẩm</label>
                                                    <div id="quill-editor-description" class="mb-3"
                                                        style="height: 400px;">
                                                    </div>
                                                    <textarea rows="3" class="mb-3 d-none" name="description" id="quill-editor-area-description">
                                                    </textarea>
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
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://unpkg.com/quill-image-resize-module@latest/image-resize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            quill('quill-editor-area-short-description', '#quill-editor-short-description')
            quill('quill-editor-area-description', '#quill-editor-description')
        });
        
        function quill(idEditorErea, idEditor) {
            if (document.getElementById(idEditorErea)) {
                var editor = new Quill(idEditor, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            // Thêm nhiều tùy chọn định dạng
                            [{
                                'font': []
                            }],
                            [{
                                'size': ['small', false, 'large', 'huge']
                            }],
                            [{
                                'header': [1, 2, 3, 4, 5, 6, false]
                            }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{
                                'color': []
                            }, {
                                'background': []
                            }],
                            // Thêm tùy chọn căn chỉnh
                            [{
                                'align': ['', 'center', 'right', 'justify']
                            }],
                            ['blockquote', 'code-block'],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }, {
                                'indent': '-1'
                            }, {
                                'indent': '+1'
                            }],
                            ['link', 'image', 'video'],
                            ['clean'],
                            // Thêm tùy chọn script/subscript
                            [{
                                'script': 'sub'
                            }, {
                                'script': 'super'
                            }],
                            // Thêm tùy chọn direction
                            [{
                                'direction': 'rtl'
                            }]
                        ],
                        imageResize: true 
                        
                    }
                });
                editor.getModule('toolbar').addHandler('image', function() {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.click();

                    input.onchange = function() {
                        var file = input.files[0];
                        if (file) {
                            var formData = new FormData();
                            formData.append('image', file);

                            fetch('{{ route('upload.image.product') }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(result => {
                                    const url = result.url;
                                    const range = editor.getSelection();
                                    editor.insertEmbed(range.index, 'image',
                                        url);
                                })
                                .catch(error => console.error('Error uploading image:', error));
                        }
                    };
                });
                var quillEditor = document.getElementById(idEditorErea);
                editor.on('text-change', function() {
                    quillEditor.value = editor.root.innerHTML;
                });
                quillEditor.addEventListener('input', function() {
                    editor.root.innerHTML = quillEditor.value;
                });
            }
        }
        document.getElementById('file-upload').addEventListener('change', function(event) {
            var files = event.target.files;

            const previewContainer = document.getElementById('product-images');
            previewContainer.innerHTML = '';

            Array.from(files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const wrapper = document.createElement('div');
                        wrapper.style.width = '120px';
                        wrapper.style.position = 'relative';
                        wrapper.className = 'me-3 mb-3';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = 'ảnh sản phẩm';
                        img.style.width = '100%';
                        img.style.border = '1px solid rgb(0, 247, 255)';

                        const deleteBtn = document.createElement('a');
                        deleteBtn.href = 'javascript:void(0);';
                        deleteBtn.className = 'btn-pc-default btn-delete-image f-18';
                        deleteBtn.style.position = 'absolute';
                        deleteBtn.style.top = '-14px';
                        deleteBtn.style.right = '-4px';
                        deleteBtn.innerText = 'x';
                        deleteBtn.dataset.index = index;

                        deleteBtn.addEventListener('click', () => {
                            wrapper.remove();
                        });

                        wrapper.appendChild(img);
                        wrapper.appendChild(deleteBtn);
                        previewContainer.appendChild(wrapper);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        document.querySelectorAll('.avtar-delete').forEach((element) => {
            element.addEventListener('click', async () => {
                const id = element.dataset.id;
                const name = element.dataset.name;

                if (id) {
                    document.getElementById('dialog-delete').innerHTML = `<div class="modal fade" id="delete-product" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="orderModalLabel">Xác nhận xóa</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p>Bạn có muốn xóa sản phẩm: <strong>${name}</strong> không?</p>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                                                        <form action="{{ route('admin.products.destroy', ':id') }}" method="post">
                                                                                            @csrf
                                                                                            @method('delete')
                                                                                            <button type="submit" class="btn btn-info">Xóa</button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>`.replace(':id', id);
                    const modal = new bootstrap.Modal(document.getElementById('delete-product'));
                    modal.show();
                }
            })
        });
    </script>
@endsection
