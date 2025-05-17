<div class="modal fade" id="edit-banner" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">Chỉnh sửa banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.banner.update', $banner->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="col-xl-12">
                        <div class="border rounded p-3 h-100 mb-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <p class="mb-0 f-18">Ảnh</p>
                                <label for="file-upload-edit" class="custom-file-upload">
                                    <i class="fas fa-upload"></i>
                                    Thêm ảnh
                                </label>
                                <input type="file" id="file-upload-edit" name="image" style="display: none"
                                    accept="image/*">
                            </div>
                            <div class="text-center" id="banner-image-edit">
                                <img src="{{ $banner->image_path }}" width="50%" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Trạng thái</label>
                        <select name="status" class="form-select" id="">
                            <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ $banner->status == 0 ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-info">Chỉnh sửa</button>
                </form>
            </div>
        </div>
    </div>
</div>
