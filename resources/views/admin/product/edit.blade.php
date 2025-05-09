@extends('admin.layout.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Thống kê</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Quản lý sản phẩm</a></li>
                        <li class="breadcrumb-item" aria-current="page">Chỉnh sửa</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Chỉnh sửa</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $product->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row g-3">
                            <div class="col-sm-6 col-xl-6">
                                <div class="mb-3 mb-0">
                                    <label class="form-label">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm"
                                        required value="{{ $product->name }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-6">
                                <div class="mb-3 mb-0">
                                    <label class="form-label">Giá bán sản phẩm</label>
                                    <input type="text" name="price" class="form-control money"
                                        placeholder="Giá sản phẩm" required value="{{ $product->price }}">
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
                                        <input type="file" id="file-upload" name="images[]" style="display: none"
                                            accept="image/*" multiple>
                                    </div>
                                    <div class="d-flex" id="product-images">

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                                <div class="mb-3 mb-0">
                                    <label class="form-label">Số lượng trong kho</label>
                                    <input type="text" name="stock_quantity" class="form-control"
                                        placeholder="Số lượng trong kho" required value="{{ $product->stock_quantity }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                                <div class="mb-3 mb-0">
                                    <label class="form-label">Danh mục</label>
                                    <select name="category_id" class="form-select" id="" required>
                                        @foreach ($categories as $it)
                                            @if ($product->category_id == $it->id)
                                                <option value="{{ $it->id }}" selected>{{ $it->name }}</option>
                                            @else
                                                <option value="{{ $it->id }}">{{ $it->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-4">
                                <div class="mb-3 mb-0">
                                    <label class="form-label">Giá sau khi giảm</label>
                                    <input type="text" class="form-control money" placeholder="Giá trước khi giảm"
                                        value="{{ $product->sale_price }}" name="sale_price">

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3 mb-0"><label class="form-label">Mô tả ngắn</label>
                                    <div id="quill-editor-short-description" class="mb-3" style="height: 250px;">
                                    {!! $product->short_description !!} 
                                    </div>
                                    <textarea rows="3" class="mb-3 d-none" name="short_description" id="quill-editor-area-short-description">
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3 mb-0"><label class="form-label">Mô tả sản phẩm</label>
                                    <div id="quill-editor-description" class="mb-3" style="height: 400px;">
                                    {!! $product->description !!}
                                    </div>
                                    <textarea rows="3" class="mb-3 d-none" name="description" id="quill-editor-area-description">
                                    </textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row align-items-end justify-content-end g-3">
                                    <div class="col-sm-auto btn-page">
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://unpkg.com/quill-image-resize-module@latest/image-resize.min.js"></script>
    <script>
        let images = <?php echo json_encode($product->images); ?>;

        document.addEventListener('DOMContentLoaded', function() {
            quill('quill-editor-area-short-description', '#quill-editor-short-description')
            quill('quill-editor-area-description', '#quill-editor-description')
            showImage(images);
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

                // Set initial content from div into editor

                // Upload image handler
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
                                    editor.insertEmbed(range.index, 'image', url);
                                })
                                .catch(error => console.error('Error uploading image:', error));
                        }
                    };
                });

                var quillEditor = document.getElementById(idEditorErea);
                quillEditor.value = editor.root.innerHTML;

                // Sync changes to hidden textarea
                editor.on('text-change', function() {
                    quillEditor.value = editor.root.innerHTML;
                });

                // let initialContent = document.getElementById(idEditorErea);
                // editor.root.innerHTML = initialContent.value || '';

                // Sync textarea back to editor when typing manually (if ever)
                quillEditor.addEventListener('input', function() {
                    editor.root.innerHTML = quillEditor.value;
                });
            }
        }
        document.getElementById('file-upload').addEventListener('change', function(event) {
            var files = event.target.files;

            const previewContainer = document.getElementById('product-images');
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


        function showImage(images) {
            let listImages = '';
            images.forEach((it) => {
                listImages += `<div style="width: 120px; position: relative" class="me-3 mb-3">
                            <img src="${it.image_path}" width="100%" style="border: 1px solid rgb(0, 247, 255)" alt="ảnh sản phẩm">
                            <a href="javascript:void(0);" class="btn-pc-default btn-delete-image f-18"
                               style="position: absolute; top: -14px; right: -4px;" data-id="${it.id}">x</a>
                        </div>`;
            });

            const productImagesElement = document.getElementById('product-images');

            productImagesElement.innerHTML = listImages;
        }
        document.addEventListener('DOMContentLoaded', () => {
            const productImagesElement = document.getElementById('product-images');

            productImagesElement.addEventListener('click', (event) => {
                if (event.target.classList.contains('btn-delete-image')) {
                    const imageId = event.target.getAttribute('data-id');
                    if (imageId) {
                        deleteImage(imageId);
                    }
                }
            });
        });
        async function deleteImage(imageId) {
            try {
                const response = await fetch(`{{ route('admin.product.image.delete', ':id') }}`.replace(':id',
                    imageId), {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    }
                });

                const data = await response.json();

                if (!response.ok) {
                    alert('Có lỗi xảy ra khi xóa ảnh');
                    return;
                }

                showImage(data.images);
            } catch (error) {
                console.error('Có lỗi xảy ra khi thực hiện yêu cầu xóa ảnh:', error);
                alert('Có lỗi khi xóa ảnh');
            }
        }
    </script>
@endsection
