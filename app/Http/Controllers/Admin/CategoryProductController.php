<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryQuery = Category::with('products');
        if(request('name')){
            $categoryQuery->where('name', 'like', '%' .request('name') . '%');
        }
        
        $categories = $categoryQuery->orderBy('created_at', 'DESC')->paginate(15);

        return view('admin.category-product.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required', 'icon' => 'nullable']);

        Category::create([
            'name' => $request->name,
            'icon' => $request->icon
        ]);

        return redirect()->back()->with('success', 'Thêm mới danh mục thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        if (!$category){
            return response()->json([
                'massage' => 'Danh mục không tồn tại'
            ], 404);
        }
        return response()->json([
            'category' => $category
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['name' => 'required', 'icon' => 'nullable']);

        $category = Category::find($id);

        if (!$category){
            return redirect()->back()->with('error', 'Danh mục không tồn tại');
        }

        $category->update([
            'name' => $request->name,
            'icon' => $request->icon
        ]);

        return redirect()->back()->with('success', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category){
            return redirect()->back()->with('error', 'Danh mục không tồn tại');
        }

        $category->delete();

        return redirect()->back()->with('success', 'Xóa danh mục thành công');
    }
}
