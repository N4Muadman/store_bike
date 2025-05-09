<div class="modal fade" id="edit-post" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">Chỉnh sửa bài viết</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.posts.update', $blog->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="mb-3 mb-0">
                                                <label class="form-label">Tiêu đề</label>
                                                <input type="text" class="form-control" name="title" placeholder="Tiều đề bài viết" value="{{ $blog->title }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="border rounded p-3 h-100">
                                                <div class="d-flex flex-column align-items-center justify-content-center mb-2">
                                                    <p class="mb-0 f-16">Ảnh</p>
                                                    <label for="file-upload-edit" class="custom-file-upload">
                                                        <i class="fas fa-upload"></i>
                                                        Thêm ảnh
                                                    </label>
                                                    <input type="file" id="file-upload-edit" class="file-upload" name="image" style="display: none"
                                                        accept="image/*">
                                                    <div id="file-info-edit" style="margin-top: 10px;"></div>
                                                </div>
                                                <div class="text-center" id="product-images">
                                                    <img src="{{ $blog->image }}" width="50%" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3 mb-0">
                                                <label class="form-label">Danh mục</label>
                                                <input name="categories" class="form-control" id="categories_edit" placeholder="Nhập danh mục và nhấn Enter"  value="{{ $blog->sub_categories }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3 mb-0"><label class="form-label">Nội dung ngắn</label>
                                                <textarea class="form-control" name="short_content" rows="3" placeholder="Nội dung ngắn" required>{{ $blog->short_content }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3 mb-0"><label class="form-label">Nội dung chính</label>
                                                <textarea class="form-control content" name="content" rows="3" placeholder="Nội dung chính">{{ $blog->content }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="row align-items-end justify-content-end g-3">
                                                <div class="col-sm-auto btn-page">
                                                    <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
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
