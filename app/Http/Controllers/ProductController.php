<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductView;
use App\Models\Review;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class ProductController extends Controller
{
    public function index(Request $request){
        $price_min = $request->price_min ?? 0;
        $price_max = $request->price_max ?? 100000000;

        $productQuery = Product::with('reviews', 'images', 'category')
                    ->whereBetween('price', [$price_min, $price_max]);

        $categoryQuery = Category::with('products');

        if ( $request->category ){
            $productQuery->whereHas('category', function ($query) use ($request){
                $query->whereIn('name', $request->category);
            });
        }

        if ( $request->search ){
            $productQuery->where('name', 'like', '%' .$request->search .'%');
        }

        if( $request->rating ){
            $productQuery->whereHas('reviews', function ($query) use ($request){
                $query->whereIn('rating', $request->rating);
            });
        }

        if ($request->sort){
            $this->sortOrder($request->sort, $productQuery);
        }else{
            $productQuery->OrderByDesc('created_at');
        }

        $products = $productQuery->paginate(12);

        $categories = $categoryQuery->orderBy('name')->get();
        return view('pages.products.index', compact('products', 'categories'));
    }

    public function sortOrder($sort, $query){
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->latest();
        }
    }

    public function quickView($id){
        try{
            $product = Product::with('reviews','category','images')->findOrFail($id);

            return view('pages.products.quick_view', compact('product'));
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'product not found',
            ], 404);
        } catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function productDetail($id){
        try{
            $product = Product::with(['reviews' => function ($query) {
                $query->paginate(10);
            },'category', 'images'])->find($id);

            if(!$product){
                return abort(404);
            }

            $product->increment('view_count');

            ProductView::create([
                'product_id' => $product->id
            ]);

            $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->orderBy('created_at' , 'desc')
            ->take(10)->get();

            $categories = Category::where('id', '!=', $product->category_id)->get();
            $suggestedProducts = collect();

            foreach ($categories as $category) {
                $suggestedProduct = Product::where('category_id', $category->id)
                                        ->where('id','!=', $product->id)
                                        ->inRandomOrder()
                                        ->first();
                if ($suggestedProduct) {
                    $suggestedProducts->push($suggestedProduct);
                }
            }
            
            return view('pages.products.detail', compact('product', 'relatedProducts', 'suggestedProducts'));
        }catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function review(Request $request, $product_id){
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'content' => 'required',
            'rating' => 'required'
        ]);

        Review::create([
            'product_id' => $product_id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'content' => $request->content,
            'rating' => $request->rating,
            'status' => 0
        ]);

        return redirect()->back()->with('success', 'Đánh giá thành công');
    }
}
