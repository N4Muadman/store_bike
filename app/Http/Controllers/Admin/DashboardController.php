<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request){
        $orerQuery = Order::Query();

        $startDate = Carbon::createFromFormat('Y-m-d', $request->start_date ?? now()->startOfMonth()->format('Y-m-d'));
        $endDate = Carbon::createFromFormat('Y-m-d', $request->end_date ?? now()->endOfMonth()->format('Y-m-d'));

        $orerQuery->whereBetween('created_at', [$startDate, $endDate]);

                $countOrder = $orerQuery->count();

        $countOrderNew = (clone $orerQuery)->where('status', 1)->count();
        $countOrderShipping = (clone $orerQuery)->where('status', 2)->count();
        $countOrdercomplete = (clone $orerQuery)->where('status', 3)->count();
        $countOrdercancel = (clone $orerQuery)->where('status', 4)->count();

        $totalRevenue = (clone $orerQuery)->where('status', 3)->sum('total');

        $dailyRevenue = (clone $orerQuery)
            ->select(DB::raw('DATE(created_at) as date'), DB::Raw('SUM(total) as order_revenue'))
            ->where('status', 3)
            ->groupBy(DB::Raw('DATE(created_at)'))->get();

        $topProduct = OrderItem::with('order','product', 'product.images')
            ->select('product_id', DB::raw('Sum(quantity) as quantity'), DB::raw('sum(total_price) as total_price'))
            ->whereHas('order', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate])->where('status', 3);
            })
            ->groupBy('product_id')
            ->orderBy('quantity')
            ->take(10)->get();

        return view('admin.dashboard.index', compact('countOrder', 'totalRevenue','countOrderNew', 'countOrderShipping', 'countOrdercomplete', 'countOrdercancel', 'dailyRevenue', 'topProduct'));
    }


}
