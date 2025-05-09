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
        $categoryQuery = Category::with('products', 'categoryParent', 'categoryChilden')->where('level', 1);
        if(request('name')){
            $categoryQuery->where('name', 'like', '%' .request('name') . '%');
        }
        if(request('level')){
            $categoryQuery->where('level', request('name'));
        }
        $categories = $categoryQuery->orderBy('created_at', 'DESC')->paginate(15);
        $categoriesSelect = $categoryQuery->where('level', 1)->orderBy('name', 'ASC')->get();

        return view('admin.category-product.index', compact('categories', 'categoriesSelect'));
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
        $request->validate(['name' => 'required', 'level' => 'required']);

        if ($request->level == 2 && !$request->category_parent){
            return redirect()->back()->with('error', 'Chưa chọn danh mục cha cho danh mục level 2');
        }

        Category::create([
            'name' => $request->name,
            'parent_id' => $request->category_parent ?? 0,
            'level' => $request->level,
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
        $request->validate(['name' => 'required', 'level' => 'required']);

        if ($request->level == 2 && !$request->category_parent){
            return redirect()->back()->with('error', 'Chưa chọn danh mục cha cho danh mục level 2');
        }

        $category = Category::find($id);

        if (!$category){
            return redirect()->back()->with('error', 'Danh mục không tồn tại');
        }

        $category->update([
            'name' => $request->name,
            'parent_id' => $request->category_parent ?? 0,
            'level' => $request->level,
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
