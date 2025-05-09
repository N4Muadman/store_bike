<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\CustomerNeedAdvice;
use App\Models\EmbedVideos;
use App\Models\Product;
use App\Models\Review;
use App\Models\SliderHome;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $productQuery = Product::with('images');

        $categories = Category::OrderBy('name')->get();

        $products = (clone $productQuery)->inRandomOrder()->take(8)->get();

        $saleProducts = (clone $productQuery)->where('sale_price', '>', 0)->orderByDesc('created_at')->take(8)->get();

        $bestSellingProducts = (clone $productQuery)->OrderBy('total_purchases')->take(8)->get();

        return view('pages.home', compact('categories','products' ,'saleProducts', 'bestSellingProducts'));
    }

    public function hotDeal(Request $request)
    {
        $productQuery = Product::with('reviews', 'images', 'category')
            ->select('*')
            ->selectRaw('
            (
                (total_purchases * 2 + view_count) / GREATEST(stock_quantity, 1)
                * CASE
                    WHEN sale_price > 0 THEN price / sale_price
                    ELSE 1
                END
            ) as hot_score
        ');
        $categoryQuery = Category::with('products');
        if ($request->category_l1) {
            $productQuery->whereHas('category.categoryParent', function ($query) use ($request) {
                $query->where('name', $request->category_l1);
            });
        }
        if ($request->category) {
            $productQuery->whereHas('category', function ($query) use ($request) {
                $query->where('name', $request->category);
            });
        }
        if ($request->search) {
            $productQuery->where('name', 'like', '%' . $request->search . '%');
        }
        $products = $productQuery
            ->having('hot_score', '>=', 20)
            ->orderByDesc('hot_score')
            ->paginate(10);

        $categories = $categoryQuery->orderBy('name')->get();
        return view('pages.hot-deal', compact('products', 'categories'));
    }

    public function promotion(Request $request)
    {
        $productQuery = Product::with('reviews', 'images', 'category')->where('sale_price', '>', 0);
        $categoryQuery = Category::with('products');
        if ($request->category_l1) {
            $productQuery->whereHas('category.categoryParent', function ($query) use ($request) {
                $query->where('name', $request->category_l1);
            });
        }
        if ($request->category) {
            $productQuery->whereHas('category', function ($query) use ($request) {
                $query->where('name', $request->category);
            });
        }
        if ($request->search) {
            $productQuery->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $productQuery->orderBy('created_at', 'desc')->paginate(14);
        $categories = $categoryQuery->orderBy('name')->get();
        return view('pages.promotion', compact('products', 'categories'));
    }

    public function news()
    {
        return view('pages.news');
    }

    public function aboutUs()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }
    public function faqs()
    {
        return view('pages.faqs');
    }
    public function ourService()
    {
        return view('pages.our-service');
    }
    public function factory()
    {
        return view('pages.factory');
    }

    public function warrantyPolicy()
    {
        return view('pages.warranty-policy');
    }
    public function shippingPolicy()
    {
        return view('pages.shipping-policy');
    }
    public function privacyPolicy()
    {
        return view('pages.privacy-policy');
    }
    public function termsConditions()
    {
        return view('pages.terms-conditions');
    }

    public function priceCommitment()
    {
        return view('pages.price-commitment');
    }
    public function feedbackService()
    {
        return view('pages.feedback-service');
    }
}
