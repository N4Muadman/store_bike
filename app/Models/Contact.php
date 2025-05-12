<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'product_id',
        'message',
        'is_read'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
