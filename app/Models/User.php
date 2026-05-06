<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'role',
        'phone',
        'address',
        'bio',
        'avatar_url',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    public function isAdmin()
    {
        return $this->is_admin === true || $this->role === 'admin' || $this->role === 'super_admin';
    }

    public function isSuperAdmin()
    {
        return $this->role === 'super_admin' || $this->is_admin == 1;
    }

    // Relationships
    public function snookerBookings()
    {
        return $this->hasMany(SnookerBooking::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}