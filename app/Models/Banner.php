<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'status'
    ];

    public function getStatusLabelAttribute()
    {
        $statuses = [
            0 => '<span class="text-danger">Đang ẩn</span>',
            1 => '<span class="text-info">Hiển thị</span>'
        ];

        return $statuses[$this->status] ?? 'Unknown';
    }
}
