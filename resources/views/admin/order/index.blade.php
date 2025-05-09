@extends('admin.layout.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin">Thống kê</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Quản lý đơn hàng</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2">Danh sách đơn hàng</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (!request('start_date') && !request('end_date'))
        <p class="f-18">Lọc theo tháng nay</p>
    @endif
    <form action="{{ route('order.index') }}" method="get">
        <div class="row align-items-center mb-3">
            <div class="col-12 col-md-2">
                <input type="text" class="form-control" name="order_id" placeholder="Tìm kiếm theo mã đơn hàng" value="{{ request('order_id') }}">
            </div>
            <div class="col-12 col-md-3">
                <select name="status" id="" class="form-select">
                    <option value="" selected >Tìm kiếm theo trạng thái</option>
                    <option value="0" {{ request('status') == 1 ? 'selected': '' }}>Mới đặt hàng</option>
                    <option value="1" {{ request('status') == 2 ? 'selected': '' }}>Đang giao</option>
                    <option value="2" {{ request('status') == 3 ? 'selected': '' }}>Hoàn tất</option>
                    <option value="3" {{ request('status') == 4 ? 'selected': '' }}>Đã bị hủy</option>
                </select>
            </div>
            <div class="col-12 col-md-2">
                <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}">
            </div>
            <div class="col-12 col-md-2">
                <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}">
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
                                    <th>SDT</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>Tổng giá</th>
                                    <th>Trạng thái</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->full_name }}</td>
                                        <td>{{ $order->phone_number }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td style="width: 40%">{{ $order->address }}</td>
                                        <td>{{ number_format($order->total, 0, '.', ',') }} đ</td>
                                        <td>{!! $order->status_label !!}</td>
                                        <td>
                                            <a href="#" class="avtar avtar-details avtar-xs btn-link-secondary" data-id="{{ $order->id }}" title="XEM CHI TIẾT">
                                                <i class="ti ti-eye f-20"></i>
                                            </a>
                                            <a href="#"class="avtar avtar-change avtar-xs btn-link-secondary" data-id="{{ $order->id }}" title="CẬP NHẬT TRẠNG THÁI">
                                                <i class="ti ti-edit f-20"></i>
                                            </a>
                                            <a href="#" class="avtar avtar-delete avtar-xs btn-link-secondary" data-id="{{ $order->id }}" title="XÓA ĐƠN HÀNG">
                                                <i class="ti ti-trash f-20"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            <p class="text-center">không có đơn hàng nào</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="ps-5 pe-5">
                            {{ $orders->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="order-item-dialog"></div>
    <div id="change-status-dialog"></div>
    <div id="delete-dialog"></div>


<script>
    document.querySelectorAll('.avtar-details').forEach((element) => {
        element.addEventListener('click', async () => {
            const id = element.dataset.id;

            if (id){
                const response = await fetch('{{ route('order.getOrderItem', ':id') }}'.replace(':id', id), {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    }
                });

                const data = await response.text();
                if (!response.ok){
                    alert('Có lỗi xảy ra');
                    return;
                }
                document.getElementById('order-item-dialog').innerHTML = data;
                const modal = new bootstrap.Modal(document.getElementById('order-item'));
                modal.show();
            }
        });
    });

    document.querySelectorAll('.avtar-change').forEach((element) => {
        element.addEventListener('click', async () => {
            const id = element.dataset.id;
            if (id){
                document.getElementById('change-status-dialog').innerHTML = `<div class="modal fade" id="change-status" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-xs">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="orderModalLabel">Thay đổi trạng thái đơn hàng</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p>Thay đổi trang thái đơn hàng của Mã đơn hàng : <strong>${id}</strong></p>
                                                                                    <form method="post" action="{{ route('order.changeStatus', ':id') }}">
                                                                                        @csrf
                                                                                        <label class="control-label">Chọn trạng thái</label>
                                                                                        <select name="status" class="form-select mb-3" required>
                                                                                            <option value="" selected>Chọn trạng thái</option>
                                                                                            <option value="2">Đang giao hàng</option>
                                                                                            <option value="3">Hoàn tất</option>
                                                                                            <option value="4">Đã bị hủy</option>
                                                                                        </select>
                                                                                        <button type="submit" class="btn btn-info">Cập nhật</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>`.replace(':id', id);
                const modal = new bootstrap.Modal(document.getElementById('change-status'));
                modal.show();
            }
        });
    });
    document.querySelectorAll('.avtar-delete').forEach((element) => {
        element.addEventListener('click', async () => {
            const id = element.dataset.id;
            if (id){
                document.getElementById('delete-dialog').innerHTML = `<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-xs">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="orderModalLabel">Xác nhận xóa đơn hàng</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p>Bạn có muốn xóa đơn hàng : <strong>${id}</strong> không?</p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                                                    <form method="post" action="{{ route('order.delete', ':id') }}">
                                                                                        @csrf
                                                                                        @method('delete')
                                                                                        <button type="submit" class="btn btn-info">Xóa</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>`.replace(':id', id);
                const modal = new bootstrap.Modal(document.getElementById('delete'));
                modal.show();
            }
        });
    });
</script>
@endsection
