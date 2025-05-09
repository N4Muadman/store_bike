<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postQuery = Blog::with('user');
        if(request('title')){
            $postQuery->where('title', 'like', '%' .request('title') . '%');
        }
        $posts = $postQuery->orderBy('created_at', 'DESC')->paginate(15);

        return view('admin.post.index', compact('posts'));
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
            'title' => 'required|string',
            'categories' => 'required|string',
            'short_content' => 'required|string',
            'content' => 'required|string',
            'image' => 'required|image',
        ]);

        try {
            $slug = Str::slug($request->input('title'), '-');
            $categories = json_decode($request->input('categories'), true);
            $categoryValues = array_map(function ($item) {
                return $item['value'];
            }, $categories);
            $subCategoriesJson = json_encode($categoryValues);

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = '/uploads/blogs/' . $fileName;
            $file->move(public_path('uploads/blogs'), $fileName);

            Blog::create([
                'title' => $request->input('title'),
                'sub_categories' => $subCategoriesJson,
                'short_content' => $request->input('short_content'),
                'content' => $request->input('content'),
                'image' => $filePath,
                'user_id' => Auth::user()->id,
                'slug' => $slug,
            ]);

            return redirect()->back()->with('success', 'Thêm mới bài viết thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
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
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json([
                'message' => 'Bài viết không tồn tại'
            ], 404);
        }

        return view('admin.post.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string',
            'categories' => 'required|string',
            'short_content' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $blog = Blog::find($id);

        if (!$blog) {
            return redirect()->back()->with('error', 'Bài viết không tồn tại');
        }

        if ($request->hasFile('image')) {
            if ($blog->image && file_exists(public_path($blog->image))) {
                unlink(public_path($blog->image));
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = '/uploads/blogs/' . $fileName;
            $file->move(public_path('uploads/blogs'), $fileName);
        } else {
            $filePath = $blog->image;
        }

        $slug = Str::slug($request->input('title'), '-');
        $categories = json_decode($request->input('categories'), true);
        $categoryValues = array_map(function ($item) {
            return $item['value'];
        }, $categories);
        $subCategoriesJson = json_encode($categoryValues);

        $blog->update([
            'title' => $request->input('title'),
            'sub_categories' => $subCategoriesJson,
            'short_content' => $request->input('short_content'),
            'content' => $request->input('content'),
            'image' => $filePath,
            'slug' => $slug,
        ]);

        return redirect()->back()->with('success', 'Cập nhật bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json([
                'message' => 'Bài viết không tồn tại'
            ], 404);
        }
        if ($blog->image && file_exists(public_path($blog->image))) {
            unlink(public_path($blog->image));
        }
        $blog->delete();

        return redirect()->back()->with('success', 'Xóa bài viết thành công');
    }
}
