<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'short_description', 'description', 'price', 'stock_quantity', 'category_id', 'total_purchases', 'is_on_featured', 'sale_price', 'view_count'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->where('status', 1);
    }

    public function getHasSaleAttribute()
    {
        return (float) $this->sale_price > 0;
    }

    public function views()
    {
        return $this->hasMany(ProductView::class);
    }
}
