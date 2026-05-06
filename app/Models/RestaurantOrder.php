<?php
// app/Models/RestaurantOrder.php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantOrder extends Model
{
    use HasFactory;
    
    protected $table = 'restaurant_orders';
    
    protected $fillable = [
        'user_id',
        'order_number',
        'items',
        'total_amount',
        'order_type',
        'status',
        'special_requests'
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