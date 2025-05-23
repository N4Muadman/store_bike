<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent_id', 'level', 'icon'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function categoryParent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function categoryChilden(){
        return $this->hasMany(Category::class, 'parent_id');
    }
}
