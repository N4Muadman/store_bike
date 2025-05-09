<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'address',
        'payment_method',
        'total',
        'status'
    ];

    public function orderItem(){
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusLabelAttribute()
    {
        $statuses = [
            1 => '<span class="text-info">Mới đặt hàng</span>',
            2 => '<span class="text-warning">Đang giao</span>',
            3 => '<span class="text-success">Hoàn tất</span>',
            4 => '<span class="text-danger">Đã bị hủy</span>'
        ];

        return $statuses[$this->status] ?? 'Unknown';
    }
}
