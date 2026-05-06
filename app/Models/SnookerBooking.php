<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SnookerBooking extends Model
{
    protected $table = 'snooker_bookings';
    
    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'people_count',
        'booking_date',
        'start_time',
        'end_time',
        'booking_time',
        'duration_hours',
        'table_type',
        'special_requests',
        'status',
        'total_amount',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'booking_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Accessor to get formatted start time
    public function getFormattedStartTimeAttribute()
    {
        return Carbon::parse($this->start_time)->format('h:i A');
    }
    
    // Accessor to get formatted booking date
    public function getFormattedBookingDateAttribute()
    {
        return Carbon::parse($this->booking_date)->format('M d, Y');
    }
}