<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\vnpay\PaymentByVnpay;

class PaymentController extends Controller
{
    public function __construct(protected PaymentByVnpay $paymentByVnpay) {}

    public function checkout(){
        $carts = session()->get('cart', []);

        if (count($carts) == 0){
            return redirect()->route('product.index')->with('error', 'Vui lòng chọn sản phẩm trước khi thanh toán');
        }

        return view('pages.payment.checkout', compact('carts'));
    }

    public function placeOrder(Request $request){
        $request->validate([
            "full_name" => "required",
            "email" => "required|email",
            "phone_number" => "required",
            "province" => "required",
            "district" => "required",
            "ward" => "required",
            "address" => "required",
            "payment_method" => "required"
        ]);
        $carts = session()->get('cart', []);

        if (count($carts) == 0) {
            return redirect()->back()->with('error', 'Vui lòng chọn sản phẩm trước khi thanh toán!');
        }
        try {
            if ($request->payment_method == 'cash'){
                $this->paymentByCash($request, $carts);
            }elseif ($request->payment_method == 'vnpay'){
                $url_vnpay = $this->paymentByVnpay->payment($request, $carts);

                return redirect($url_vnpay);
            }


            session()->forget('cart');

            return redirect()->route('product.index')->with('success', "Bạn đã mua hàng thành công");

        }catch (\Exception $e){
            Log::error('Lỗi khi tạo đơn hàng: '.$e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function paymentByCash($request, $carts){
        DB::beginTransaction();

        try {
            $fullAddress = implode(", ", [
                "Tỉnh: $request->province",
                "Huyện: $request->district",
                "Xã: $request->ward",
                "Địa chỉ cụ thể: $request->address"
            ]);

            $order = Order::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $fullAddress,
                'payment_method' => $request->payment_method,
                'total' => 0,
                'status' => 1
            ]);
            $total = 0;

            foreach($carts as $cart){
                $product = Product::find($cart['product_id']);
                if($product->stock_quantity < $cart['quantity']){
                    DB::rollback();
                    throw new \Exception("Sản phẩm {$product->name} không đủ hàng!");
                }
                $total += $cart['quantity'] * ($cart['sale_price'] > 0 ? $cart['sale_price'] : $cart['price']);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart['product_id'],
                    'quantity' => $cart['quantity'],
                    'total_price' => $cart['quantity'] *  ($cart['sale_price'] > 0 ? $cart['sale_price'] : $cart['price']),
                ]);

                $product->update([
                    'total_purchases' => $product->total_purchases + $cart['quantity'],
                    'stock_quantity' => $product->stock_quantity - $cart['quantity']
                ]);
            }

            $order->update(['total' => $total]);

            DB::commit();

        }catch (\Throwable $e){
            DB::rollBack();

            throw $e;
        }
    }
}
