<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreOrder extends Model
{
    protected $table = 'store_orders';
    
    protected $fillable = [
        'user_id', 'order_number', 'items', 'total_amount', 
        'delivery_address', 'status'
    ];
    
    protected $casts = [
        'items' => 'array',
        'total_amount' => 'decimal:2'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}