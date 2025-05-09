<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class RivewProductController extends Controller
{
    public function index(){
        $reviews = Review::with('product')->orderBy('created_at')->paginate(10);

        return view('admin.product.review', compact('reviews'));
    }

    public function update(Request $request, $id){
        $review = Review::find($id);

        if (!$review){
            return redirect()->back()->with('error', 'Không tìm thấy đánh giá');
        }
        $data = $request->only('full_name', 'email', 'content', 'rating');
        $review->update($data);

        return redirect()->back()->with('success', 'Cập nhật thành công');
    }
    public function destroy($id){
        $review = Review::find($id);

        if (!$review){
            return redirect()->back()->with('error', 'Không tìm thấy đánh giá');
        }

        $review->delete();

        return redirect()->back()->with('success', 'Xóa đánh giá thành công');
    }
    public function approve($id){
        $review = Review::find($id);

        if (!$review){
            return redirect()->back()->with('error', 'Không tìm thấy đánh giá');
        }

        $review->update([
            'status' => $review->status == 0 ? 1 : 0,
        ]);

        return redirect()->back()->with('success', 'Phê duyệt đánh giá thành công');
    }
}
