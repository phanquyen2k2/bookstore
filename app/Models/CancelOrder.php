<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelOrder extends Model
{
    use HasFactory;
    protected $table = 'cancel_orders';
    protected $fillable = [
        'order_id',
        'user_id', 
        'cancel_reason',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
