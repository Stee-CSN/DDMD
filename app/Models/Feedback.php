<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'service_rating',
        'food_rating',
        'review'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}