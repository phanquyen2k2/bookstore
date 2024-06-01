<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id', // ID của đơn hàng
        'product_id', // ID của sản phẩm
        'product_name', // Tên sản phẩm
        'quantity', // Số lượng sản phẩm
        'price', // Giá sản phẩm
        // Thêm các thuộc tính fillable khác nếu cần
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'float',
    ];

    // Quan hệ với bảng Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Quan hệ với bảng Product (nếu cần)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
