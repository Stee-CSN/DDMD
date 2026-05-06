<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    // IMPORTANT: Tell Laravel to use the 'feedbacks' table (plural)
    protected $table = 'feedbacks';
    
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'rating',
        'comment',
        'branch',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}