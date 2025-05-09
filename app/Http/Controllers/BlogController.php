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

        $trendingProduct = Product::withCount([
            'views as recent_views' => function ($query) {
                $query->where('created_at', '>=', now()->subDays(3));
            },
            'reviews as review_count',
        ])
            ->withAvg('reviews as avg_rating', 'rating')
            ->select('*')
            ->get()
            ->map(function ($product) {
                $score =
                    ($product->recent_views ?? 0) * 1 +
                    $product->sold_quantity * 0.5 +
                    ($product->avg_rating ?? 0) * 5 +
                    ($product->review_count ?? 0) * 1;

                $product->trending_score = $score;
                return $product;
            })
            ->filter(function ($product) {
                return $product->trending_score > 10;
            })
            ->sortByDesc('trending_score')
            ->take(10);

        return view('pages.blog.index', compact('news', 'trendingProduct'));
    }
    public function detail($slug){
        $blog = Blog::where('slug', $slug)->first();

        if(!$blog){
            abort(404);
        }

        $recentBlogs = Blog::where('id', '!=', $blog->id)
        ->orderBy('created_at' , 'desc')
        ->take(4)->get();

        $trendingProduct = Product::withCount([
            'views as recent_views' => function ($query) {
                $query->where('created_at', '>=', now()->subDays(3));
            },
            'reviews as review_count',
        ])
            ->withAvg('reviews as avg_rating', 'rating')
            ->select('*')
            ->get()
            ->map(function ($product) {
                $score =
                    ($product->recent_views ?? 0) * 1 +
                    $product->sold_quantity * 0.5 +
                    ($product->avg_rating ?? 0) * 5 +
                    ($product->review_count ?? 0) * 1;

                $product->trending_score = $score;
                return $product;
            })
            ->filter(function ($product) {
                return $product->trending_score > 10;
            })
            ->sortByDesc('trending_score')
            ->take(10);

        return view('pages.blog.detail', compact('blog', 'trendingProduct', 'recentBlogs'));
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
