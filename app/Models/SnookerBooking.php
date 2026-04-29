<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SnookerBooking extends Model
{
    use HasFactory;

    protected $table = 'snooker_bookings';

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'people_count',
        'booking_date',
        'booking_time',
        'start_time',
        'end_time',
        'duration_hours',
        'table_type',
        'special_requests',
        'status',
        'total_amount',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}