<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('created_at', 'desc')->get();

        return view('admin.banner.index', compact('banners'));
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
            'image' => 'required|mimes:png,jpg,jpeg,gif,webp'
        ]);

        try {
            if ($request->hasFile('image')){
                $banner = $request->file('image');
                $fileName = time() .'_' .$banner->getClientOriginalName();
                $filePath = '/uploads/banners/' . $fileName;
                $banner->move(public_path('uploads/banners'), $filePath);

                Banner::create([
                    'image_path' => $filePath,
                    'status' => $request->status
                ]);

                return redirect()->back()->with('success', 'Thêm mới banner thành công');
            }
            else{
                return redirect()->back()->with('error', 'File ảnh không tồn tại');
            }

        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm mới');
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
        $banner = Banner::find($id);

        return view('admin.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'nullable|mimes:png,jpg,jpeg,gif,webp'
        ]);

        try {
            $banner = Banner::find($id);

            if (!$banner){
                return redirect()->back()->with('error', 'Banner không tồn tại');
            }

            if ($request->hasFile('image')){
                if ($banner->image_path && file_exists(public_path($banner->image_path))) {
                    unlink(public_path($banner->image_path));
                }

                $file = $request->file('image');
                $fileName = time() .'_' .$file->getClientOriginalName();
                $filePath = '/uploads/banners/' . $fileName;
                $file->move(public_path('uploads/banners'), $filePath);
            }else{
                $filePath = $banner->image_path;
            }

            $banner->update([
                'image_path' => $filePath,
                'status' => $request->status
            ]);

            return redirect()->back()->with('success', 'Cập nhật banner thành công');
        }catch(\Exception $e){
            Log::error('Error updating banner: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật' .$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::find($id);

        if (!$banner){
            return redirect()->back()->with('error', 'Banner không tồn tại');
        }

        if ($banner->image_path && file_exists(public_path($banner->image_path))) {
            unlink(public_path($banner->image_path));
        }

        $banner->delete();

        return redirect()->back()->with('success', 'Xóa banner thành công');
    }
}
