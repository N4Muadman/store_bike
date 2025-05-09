<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\View\Component;

class DealToday extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $dealTodayProducts = Product::with('images')
                                ->where('sale_price', '>', 0)
                                ->where('stock_quantity', '>', 0)
                                ->whereDate('updated_at', Carbon::today())
                                ->orderByDesc('updated_at')->get();

        return view('components.deal-today', compact('dealTodayProducts'));
    }
}
