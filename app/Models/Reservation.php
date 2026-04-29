<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'dining_type',
        'people_count',
        'reservation_datetime',
        'special_requests',
        'order_items',
        'order_total',
        'status'
    ];

    protected $casts = [
        'reservation_datetime' => 'datetime',
        'order_items' => 'array',
        'order_total' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}