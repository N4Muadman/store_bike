<div class="modal fade" id="order-item" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">Chi tiết đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover text-center table-fixed" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Tên sản phẩm</th>
                                <th></th>
                                <th>Số lượng</th>
                                <th>Tổng giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order_items as $it)
                                <tr>
                                    <td>{{ $it->order_id }}</td>
                                    <td>{{ $it->product->name }}</td>
                                    <td><img src="{{ $it->product->images ? $it->product->images[0]->image_path : '' }}" width="60px" alt="anh sp"></td>
                                    <td>{{ $it->quantity }}</td>
                                    <td>{{ number_format($it->total_price, 0, '.', ',') }} đ</td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <p class="text-center">không có đơn hàng nào</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
