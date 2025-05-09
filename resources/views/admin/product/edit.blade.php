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
                            <div class="col-xl-12">
                                <div class="border rounded p-3 h-100">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <p class="mb-0 f-18">Đặc điểm sản phẩm</p>
                                        <label class="custom-file-upload" id="add-characteristics">
                                            <i class="fas fa-plus"></i>
                                            Thêm Đặc Điểm
                                        </label>
                                    </div>
                                    <div class="" id="product-characteristics">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3 mb-0"><label class="form-label">Mô tả ngắn</label>
                                    <textarea class="form-control" name="short_description" rows="3" placeholder="Mô tả ngắn" required>{{ $product->short_description }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3 mb-0"><label class="form-label">Mô tả sản phẩm</label>
                                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Mô tả sản phẩm">{{ $product->description }}</textarea>
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

    <script src="https://cdn.tiny.cloud/1/qf4pnfpic603nbrs0wu0r3cyaadnairp5ngpr08muctqj041/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        let images = <?php echo json_encode($product->images); ?>;
        let characteristics = <?php echo json_encode($product->characteristics); ?>;
        let indexCharacteristics = 0

        tinymce.init({
            selector: '#description',
            advcode_inline: true,
            menubar: false,
            plugins: 'searchreplace autolink directionality visualblocks visualchars image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap linkchecker emoticons autosave fullscreen',
            toolbar: "undo redo print spellcheckdialog formatpainter | blocks fontfamily fontsize | bold italic underline forecolor backcolor | link image | alignleft aligncenter alignright alignjustify | code",
            height: '450px'
        });
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

        function showCharacteristics(characteristics){
            listCharacteristics = '';
            characteristics.forEach((it, index) => {
                listCharacteristics += `<div class="row justify-content-between mb-3">
                                                            <div class="col-6 d-flex align-items-center">
                                                                <label for="" style="min-width: 95px" class="me-3">Tên đặc điểm</label>
                                                                <input type="text" class="form-control" name="characteristics[${index}][name]" value="${it.name}"
                                                                    placeholder="Tên đặc điểm" required>
                                                            </div>
                                                            <div class="col-5 d-flex align-items-center">
                                                                <label for="" style="min-width: 45px" class="me-3">Mô tả</label>
                                                                <input type="text" class="form-control"
                                                                    name="characteristics[${index}][description]" placeholder="Mô tả" value="${it.description}" required>
                                                            </div>
                                                            <div class="col-1 text-end mt-2">
                                                                <button type="button"
                                                                    class="btn btn-sm remove-characteristics" data-id="${it.id}"><i
                                                                        class="ti ti-trash text-danger f-20"></i></button>
                                                            </div>
                                                        </div>`;
                indexCharacteristics++;
            });

            document.getElementById('product-characteristics').innerHTML = listCharacteristics;
        }

        document.getElementById('add-characteristics').addEventListener('click', () => {
            const container = document.getElementById('product-characteristics');

            const newColor = document.createElement('div');
            newColor.className = 'row justify-content-between mb-3';

            newColor.innerHTML = `
                <div class="col-6 d-flex align-items-center">
                                                                <label for="" style="min-width: 95px" class="me-3">Tên đặc điểm</label>
                                                                <input type="text" class="form-control" name="characteristics[${indexCharacteristics}][name]"
                                                                    placeholder="Tên đặc điểm" required>
                                                            </div>
                                                            <div class="col-5 d-flex align-items-center">
                                                                <label for="" style="min-width: 45px" class="me-3">Mô tả</label>
                                                                <input type="text" class="form-control"
                                                                    name="characteristics[${indexCharacteristics}][description]" placeholder="Mô tả" required>
                                                            </div>
                                                            <div class="col-1 text-end mt-2">
                                                                <button type="button" class="btn btn-sm remove-characteristics"><i class="ti ti-trash text-danger f-20"></i></button>
                                                            </div>
            `;

            container.appendChild(newColor);

            indexCharacteristics++;
        });

        document.getElementById('product-characteristics').addEventListener('click', (e) => {
            if (e.target.closest('.remove-characteristics')) {
                const characteristicId = e.target.closest('.remove-characteristics').getAttribute("data-id");
                console.log(characteristicId);
                
                if (characteristicId) {
                    deleteCharacteristic(characteristicId);
                }
                e.target.closest('.row').remove();
            }

        });

        async function deleteCharacteristic(id) {
            try {
                const response = await fetch(`{{ route('admin.product.color.characteristic', ':id') }}`.replace(':id',
                id), {
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

            } catch (error) {
                console.error('Có lỗi xảy ra khi thực hiện yêu cầu xóa ảnh:', error);
                alert('Có lỗi khi xóa ảnh');
                return;
            }
        }

        showImage(images);
        showCharacteristics(characteristics);
    </script>
@endsection
