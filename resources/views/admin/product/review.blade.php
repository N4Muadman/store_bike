@extends('admin.layout.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">Quản lý sản phẩm</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Đánh giá sản phẩm</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2">Danh sách đánh giá</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('review.index') }}" method="get">
        <div class="row align-items-center mb-3">
            <div class="col-12 col-md-3">
                <input type="text" class="form-control" name="product_name" placeholder="Tìm kiếm theo tên sản phẩm"
                    value="{{ request('product_name') }}">
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
                                    <th>Tên sản phẩm</th>
                                    <th></th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Nội dung đánh giá</th>
                                    <th>Số sao</th>
                                    <th>Trạng thái</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reviews as $review)
                                    @php
                                        $productName;
                                        $prductImg = null;
                                        if ($review->product) {
                                            $productName = $review->product->name;
                                            if ($review->product->images) {
                                                $prductImg = $review->product->images[0]->image_path;
                                            }
                                        }
                                    @endphp
                                    <tr>
                                        <td>
                                            {{ $productName ?? 'Không tìm thấy sản phẩm' }}
                                        </td>
                                        <td>
                                            <img src="{{ $prductImg }}" width="40px" alt="Ảnh sản phẩm">
                                        </td>
                                        <td>
                                            {{ $review->full_name }}
                                        </td>
                                        <td>
                                            {{ $review->email }}
                                        </td>
                                        <td>
                                            {{ $review->content }}
                                        </td>
                                        <td>
                                            {{ $review->rating }}
                                        </td>
                                        <td class="{{ $review->status == 0 ? 'text-danger' : 'text-success' }}">
                                            {{ $review->status == 0 ? 'Chưa được phê duyệt' : 'Đã được phê duyệt' }}
                                        </td>
                                        <td>
                                            <a href=""class="avtar avtar-change avtar-xs btn-link-secondary {{ $review->status == 0 ? 'text-danger' : 'text-success' }}"
                                                title="Phê duyệt" data-bs-toggle="modal"
                                                data-bs-target="#approve-review-{{ $review->id }}">
                                                <i
                                                    class="{{ $review->status == 0 ? 'fas fa-toggle-off f-20' : 'fas fa-toggle-on f-20' }}"></i>
                                            </a>
                                            <a href="#" class="avtar avtar-change avtar-xs btn-link-secondary"
                                                title="Sửa đánh giá" data-bs-toggle="modal"
                                                data-bs-target="#edit-review-{{ $review->id }}">
                                                <i class="ti ti-edit f-20"></i>
                                            </a>
                                            <a href="#" class="avtar avtar-delete avtar-xs btn-link-secondary"
                                                title="Xóa đánh giá" data-bs-toggle="modal"
                                                data-bs-target="#delete-review-{{ $review->id }}">
                                                <i class="ti ti-trash f-20"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            <p class="text-center">không có đáng giá nào</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="ps-5 pe-5">
                            {{ $reviews->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($reviews as $review)
        <div class="modal fade" id="delete-review-{{ $review->id }}" tabindex="-1" aria-labelledby="orderModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel">Xác nhận xóa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có muốn xóa đánh giá này không?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <form action="{{ route('review.destroy', $review->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-info">Xóa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="approve-review-{{ $review->id }}" tabindex="-1" aria-labelledby="orderModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel">Xác nhận phê duyệt</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có muốn phê duyệt đánh giá này không?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <form action="{{ route('review.approve', $review->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-info">Phê duyệt</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit-review-{{ $review->id }}" tabindex="-1" aria-labelledby="orderModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel">Chỉnh sửa đánh giá</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('review.update', $review->id) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="">Họ tên</label>
                                <input type="text" class="form-control" name="full_name" value="{{ $review->full_name }}" placeholder="Nhập họ và tên">
                            </div>
                            <div class="mb-3">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" value="{{ $review->email }}" placeholder="Nhập email">
                            </div>
                            <div class="mb-3">
                                <label for="">Số sao</label>
                                <input type="text" class="form-control" name="rating" value="{{ $review->rating }}" placeholder="Nhập số sao">
                            </div>
                            <div class="mb-3">
                                <label for="">Nội dung</label>
                                <textarea name="content" class="form-control" cols="30" rows="4">{{ $review->content }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-info">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
