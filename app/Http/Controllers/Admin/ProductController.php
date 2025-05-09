<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductCharacteristics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productQuery = Product::with('images');

        if ($request->name){
            $productQuery->where('name', 'like', '%' . $request->name .'%');
        }

        $products = $productQuery->orderBy('created_at', 'DESC')->paginate(10);
        $categories = Category::where('level', 2)->orderBy('name')->get();

        return view('admin.product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock_quantity' => 'required',
            'category_id' => 'required',
            'images' => 'required|array',
            'images.*' => 'file|mimes:png,jpeg,gif,jpg,webp',
            'characteristics' => 'required|array'
        ]);

        try{
            DB::beginTransaction();
            $price = preg_replace('/[^0-9]/', '', $request->price);
            $sale_price = $request->sale_price ? preg_replace('/[^0-9]/', '', $request->sale_price) : 0;

            $isOnSale = $request->has('is_on_sale') ? 1 : 0;
            $isOnFeature = $request->has('is_on_featured') ? 1 : 0;

            $product = Product::create([
                'name' => $request->name,
                'price' => $price,
                'stock_quantity' => $request->stock_quantity,
                'category_id' => $request->category_id,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'is_on_sale' => $isOnSale,
                'is_on_featured' => $isOnFeature,
                'sale_price' => $sale_price
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $img) {
                    if ($img->isValid()) {
                        $fileName = time() . '-' . $img->getClientOriginalName();
                        $filePath = '/uploads/products/' . $fileName;
                        $img->move(public_path('uploads/products'), $fileName);

                        Image::create([
                            'product_id' => $product->id,
                            'image_path' => $filePath
                        ]);
                    }
                }
            }

            $product->characteristics()->createMany($request->characteristics);

            DB::commit();

            return redirect()->back()->with('success', 'Thêm mới sản phẩm thành công');
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra' .$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('images', 'category')->find($id);
        $categories = Category::where('level', 2)->orderBy('name')->get();

        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại');
        }

        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock_quantity' => 'required',
            'category_id' => 'required',
            'images' => 'nullable|array',
            'images.*' => 'file|mimes:png,jpeg,gif,jpg,webp',
        ]);

        try{
            $product = Product::find($id);

            if(!$product){
                return redirect()->back()->with('error', 'Sản phẩm không tồn tại');
            }

            $price = preg_replace('/[^0-9]/', '', $request->price);
            $sale_price = $request->sale_price ? preg_replace('/[^0-9]/', '', $request->sale_price) : 0;

            $isOnSale = $request->has('is_on_sale') ? 1 : 0;
            $isOnFeature = $request->has('is_on_featured') ? 1 : 0;

            $product->update([
                'name' => $request->name,
                'price' => $price,
                'stock_quantity' => $request->stock_quantity,
                'category_id' => $request->category_id,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'is_on_sale' => $isOnSale,
                'is_on_featured' => $isOnFeature,
                'sale_price' => $sale_price
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $img) {
                    if ($img->isValid()) {
                        $fileName = time() . '-' . $img->getClientOriginalName();
                        $filePath = '/uploads/products/' . $fileName;
                        $img->move(public_path('uploads/products'), $fileName);

                        Image::create([
                            'product_id' => $product->id,
                            'image_path' => $filePath
                        ]);
                    }
                }
            }

            
            // $product->characteristics()->delete();
            // $product->characteristics()->createMany($request->characteristics);

            return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $product = Product::find($id);

            if (!$product){
                return redirect()->back()->with('error', 'Sản phẩm không tồn tại');
            }

            DB::beginTransaction();

            $product->delete();
    
            foreach($product->images as $image){
                if ($image->image_path && file_exists(public_path($image->image_path))) {
                    unlink(public_path($image->image_path));
                }
            }
    
            // $product->images()->delete();
            // $product->reviews()->delete();
            // $product->characteristics()->delete();
            // $product->views()->delete();
            
            DB::commit();

            return redirect()->back()->with('success', 'Xóa sản phẩm thành công');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Xóa Sản phẩm không thành công' .$e);
        }
    }

    public function deleteImage($id){
        $image = Image::find($id);

        if(!$image){
            return response()->json([
                'masaage' => 'Image not found'
            ], 404);
        }
        $image->delete();
        if ($image->image_path && file_exists(public_path($image->image_path))) {
            unlink(public_path($image->image_path));
        }


        $images = Image::where('product_id', $image->product_id)->get();

        return response()->json([
            'masaage' => 'Xóa ảnh thành công',
            'images' => $images,
        ], 200);
    }

}
