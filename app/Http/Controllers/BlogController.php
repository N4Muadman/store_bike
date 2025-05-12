<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index(Request $request){
        $newsQueyry = Blog::with('user');

        if ($request->search){
            $newsQueyry->where('title', 'like', '%' .$request->search .'%');
        }

        $news = $newsQueyry->orderByDesc('created_at')->paginate(12);

        return view('pages.blog.index', compact('news'));
    }
    public function detail($slug){
        $blog = Blog::where('slug', $slug)->first();

        if(!$blog){
            abort(404);
        }

        $recentBlogs = Blog::where('id', '!=', $blog->id)
        ->orderBy('created_at' , 'desc')
        ->take(4)->get();

        return view('pages.blog.detail', compact('blog', 'recentBlogs'));
    }

    public function postComment(Request $request){
        $request->validate([
            'content' => 'required',
            'blog_id' => 'required',
        ]);

        Comment::create([
            'blog_id' => $request->blog_id,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Bình luận bài viết thành công');
    }
}
