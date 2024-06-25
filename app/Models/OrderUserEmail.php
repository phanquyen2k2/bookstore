<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderUserEmail extends Model
{
    use HasFactory;

    protected $fillable = ['order_email', 'user_email'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_email', 'email');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_email', 'email');
    }
}

