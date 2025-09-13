<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefundRequest extends Model
{
    protected $fillable = [
        'order_item_id',
        'user_id',
        'status',
        'reason',
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
