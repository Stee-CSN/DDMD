<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table = 'menu_items';
    
    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'image_path',
        'is_available',
        'sort_order'
    ];
    
    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
        'sort_order' => 'integer'
    ];
    
    public function getImageUrlAttribute()
    {
        if ($this->image_path && file_exists(storage_path('app/public/' . $this->image_path))) {
            return asset('storage/' . $this->image_path);
        }
        return asset('images/no-image.png');
    }
}