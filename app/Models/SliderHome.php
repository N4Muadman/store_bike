<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderHome extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'content_btn',
        'text_position',
        'banner',
        'height_btn',
        'status',
        'color_title',
        'color_content',
        'color_btn',
        'background_color_btn',
    ];

    public function getStatusLabelAttribute()
    {
        $statuses = [
            0 => '<span class="text-danger">Đang ẩn</span>',
            1 => '<span class="text-info">Hiển thị</span>'
        ];

        return $statuses[$this->status] ?? 'Unknown';
    }
    public function getTextPositionLabelAttribute()
    {
        $positions = [
            'left' => 'Trái',
            'right' => 'Phải',
            'center' => 'Giữa'
        ];

        return $positions[$this->text_position] ?? 'Unknown';
    }
}
