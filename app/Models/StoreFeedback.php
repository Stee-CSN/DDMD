<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreFeedback extends Model
{
    protected $table = 'store_feedbacks';
    
    protected $fillable = [
        'user_id', 'rating', 'review', 'is_approved'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}