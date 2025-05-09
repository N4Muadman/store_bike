<?php

namespace App\Http\Controllers\vnpay;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class PaymentByVnpay {
    public function payment($request, $carts){
        $vnp_TmnCode = "Q9B60MZQ";
        $vnp_HashSecret = "INEZCVWNMKJNBTSSYUUVTUYYRKOVQNVV";
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('payment.vnpay.return');

        $vnp_TxnRef = Str::uuid();

        session([
            "vnp_temp_order_{$vnp_TxnRef}" => [
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'province' => $request->province,
                'district' => $request->district,
                'ward' => $request->ward,
                'address' => $request->address,
                'carts' => $carts
            ]
        ]);

        $vnp_OrderInfo = 'Thanh toán đơn hàng';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = array_reduce($carts, function ($carry, $cart) {
            $price = $cart['sale_price'] > 0 ? $cart['sale_price'] : $cart['price'];
            return $carry + $cart['quantity'] * $price;
        }, 0);

        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset ($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnp_Url;

    }

    public function handlePaymentReturn(Request $request)
    {
        $vnp_HashSecret = "INEZCVWNMKJNBTSSYUUVTUYYRKOVQNVV";

        $inputData = $request->all();
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);

        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash === $vnp_SecureHash && $inputData['vnp_ResponseCode'] === '00') {
            $txnRef = $inputData['vnp_TxnRef'];
            $sessionKey = "vnp_temp_order_{$txnRef}";
            $tempOrder = session()->get($sessionKey);
    
            if (!$tempOrder) {
                return redirect()->route('product.index')->with('error', 'Không tìm thấy đơn hàng tạm');
            }
    
            // Tạo full address
            $fullAddress = implode(", ", [
                "Tỉnh: {$tempOrder['province']}",
                "Huyện: {$tempOrder['district']}",
                "Xã: {$tempOrder['ward']}",
                "Địa chỉ cụ thể: {$tempOrder['address']}"
            ]);
    
            // Bắt đầu tạo đơn hàng
            DB::beginTransaction();
            try {
                $order = Order::create([
                    'full_name' => $tempOrder['full_name'],
                    'email' => $tempOrder['email'],
                    'phone_number' => $tempOrder['phone_number'],
                    'address' => $fullAddress,
                    'payment_method' => 'vnpay',
                    'total' => 0,
                    'status' => 1
                ]);
    
                $total = 0;
    
                foreach ($tempOrder['carts'] as $cart) {
                    $product = Product::find($cart['product_id']);
                    if (!$product || $product->stock_quantity < $cart['quantity']) {
                        throw new \Exception("Sản phẩm {$product->name} không đủ hàng.");
                    }
    
                    $price = $cart['sale_price'] > 0 ? $cart['sale_price'] : $cart['price'];
                    $lineTotal = $cart['quantity'] * $price;
                    $total += $lineTotal;
    
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cart['product_id'],
                        'quantity' => $cart['quantity'],
                        'total_price' => $lineTotal,
                    ]);
    
                    $product->update([
                        'stock_quantity' => $product->stock_quantity - $cart['quantity'],
                        'total_purchases' => $product->total_purchases + $cart['quantity']
                    ]);
                }
    
                $order->update(['total' => $total]);
                DB::commit();
    
                session()->forget($sessionKey);
                session()->forget('cart');
    
                return  redirect()->route('product.index')->with('success', 'Thanh toán thành công');
            } catch (\Throwable $e) {
                DB::rollBack();
                Log::error('Lỗi khi tạo đơn hàng sau khi thanh toán: ' . $e->getMessage());
                return  redirect()->route('product.index')->with('error', 'Lỗi khi tạo đơn hàng sau khi thanh toán');
            }
        }
    
        return  redirect()->route('product.index')->with('error', 'Xác minh thanh toán thất bại');
    }

}