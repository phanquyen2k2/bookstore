<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{   
    protected $table = 'orders';
    protected $fillable = [
        'id_user',//ID của người dùng
        'name', // Tên của người đặt hàng
        'email', // Email của người đặt hàng
        'address', // Địa chỉ giao hàng
        'phone', // Số điện thoại của người đặt hàng
        'note', // Ghi chú
        'total_quantity', // Tổng số lượng sản phẩm trong đơn hàng
        'total_price', // Tổng giá tiền của đơn hàng
        'payment_method', // Phương thức thanh toán
        'status', // Trạng thái đơn hàng
        // Thêm các thuộc tính fillable khác nếu cần
    ];
    public function orderUserEmails()
    {
        return $this->hasMany(OrderUserEmail::class, 'order_email', 'email');
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, OrderUserEmail::class, 'order_email', 'email', 'email', 'user_email');
    }

    protected $casts = [
        'total_quantity' => 'integer',
        'total_price' => 'float',
    ];

    // Khai báo các trạng thái của đơn hàng
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_PAID = 'paid'; // Trạng thái đã thanh toán

    // Lấy trạng thái đơn hàng dưới dạng chuỗi
    public function getStatusTextAttribute()
    {  
        switch ($this->status) {
            case self::STATUS_PENDING:
                return 'Pending';
            case self::STATUS_PROCESSING:
                return 'Processing';
            case self::STATUS_COMPLETED:
                return 'Completed';
            case self::STATUS_CANCELLED:
                return 'Cancelled';
            case self::STATUS_PAID:
                return 'Paid';
            default:
                return 'Unknown';
        }
    }

    // Quan hệ với bảng OrderDetail
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
