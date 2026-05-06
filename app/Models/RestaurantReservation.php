<?php
// app/Models/RestaurantReservation.php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantReservation extends Model
{
    use HasFactory;
    
    protected $table = 'restaurant_reservations';
    
    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_phone',
        'number_of_guests',
        'reservation_date',
        'reservation_time',
        'special_requests',
        'status'
    ];
    
    protected $casts = [
        'reservation_date' => 'date',
        'reservation_time' => 'datetime'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}