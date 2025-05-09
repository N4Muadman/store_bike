<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index() {
        $carts = session()->get('cart', []);

        return view('pages.cart.index', compact('carts'));
    }

    public function getCarts(){
        $carts = session()->get('cart', []);

        return response()->json([
            'message' => 'list cart',
            'carts' => $carts
        ], 200);
    }


    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);
        if (!$product) {
            return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
        }
        $image = Image::select('image_path')->where('product_id', $product->id)->first();

        $carts = session()->get('cart', []);

        $found = false;
        foreach ($carts as &$cart) {
            if ($cart['product_id'] == $product->id) {
                $cart['quantity'] += $request->quantity?? 1;
                $found = true;
                break;
            }
        }
        if (!$found) {

            $carts[] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'image' => $image->image_path,
                'quantity' => $request->quantity ?? 1,
                'price' => $product->price,
                'sale_price' => $product->sale_price
            ];
        }

        session()->put('cart', $carts);

        return response()->json(['message' => 'Thêm vào giỏ hàng thành công'], 201);
    }

    public function deleteCart($index){
        $carts = session()->get('cart', []);

        $index = (int) $index;
        if (isset($carts[$index])) {
            unset($carts[$index]);

            $carts = array_values($carts);

            session()->put('cart', $carts);

            return response()->json(['message' => 'Xóa sản phẩm khỏi giỏ hàng thành công'], 200);
        }

        return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
    }

    public function decrease($index){
        $carts = session()->get('cart', []);

        $index = (int) $index;
        if (isset($carts[$index])) {
            if ($carts[$index]['quantity'] > 1) {
                $carts[$index]['quantity'] -= 1;
            } else {
                return response()->json(['message' => 'Số lượng sản phẩm không thể nhỏ hơn 1'], 400);
            }

            session()->put('cart', $carts);

            return response()->json(['message' => 'Số lượng sản phẩm đã được giảm'], 200);
        }
        return response()->json(['message' => 'Không tìm thấy sản phẩm trong giỏ hàng'], 404);
    }
    public function increase($index){
        $carts = session()->get('cart', []);

        $index = (int) $index;
        if (isset($carts[$index])) {
            $carts[$index]['quantity'] += 1;

            session()->put('cart', $carts);

            return response()->json(['message' => 'Số lượng sản phẩm đã được giảm'], 200);
        }
        return response()->json(['message' => 'Không tìm thấy sản phẩm trong giỏ hàng'], 404);
    }
}
