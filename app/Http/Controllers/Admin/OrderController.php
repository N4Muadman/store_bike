<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function index(){
        try {
            $start_date = request('start_date')
                ? Carbon::createFromFormat('Y-m-d', request('start_date'))->startOfDay()
                : now()->startOfMonth();

            $end_date = request('end_date')
                ? Carbon::createFromFormat('Y-m-d', request('end_date'))->endOfDay()
                : now()->endOfMonth();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ngày tháng không hợp lệ.');
        }

        $orders = Order::where('status', '!=', 5)
            ->when(request('order_id'), fn($query, $order_id) => $query->where('id', $order_id))
            ->when(request('status'), fn($query, $status) => $query->where('status', $status))
            ->when(request('payment_method'), fn($query, $payment_method) => $query->where('payment_method', $payment_method))
            ->whereBetween('created_at', [$start_date, $end_date])
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

        return view('admin.order.index', compact('orders'));
    }

    public function getOrderItem($id){
        $order_items = OrderItem::with('product', 'product.images')->where('order_id', $id)->get();
        return view('admin.order.detail', compact('order_items'));
    }

    public function changeStatus($id){
        $order = Order::find($id);

        if (!$order){
            return redirect()->back()->with('error', 'Order not found');
        }

        $order->update([
            'status' => request('status')
        ]);

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
    }
    public function delete($id){
        $order = Order::find($id);

        if (!$order){
            return redirect()->back()->with('error', 'Order not found');
        }

        $orderItemIds = OrderItem::where('order_id', $order->id)->pluck('id');

        OrderItem::destroy($orderItemIds);
        $order->delete();

        return redirect()->back()->with('success', 'Xóa đơn hàng thành công');
    }
}
