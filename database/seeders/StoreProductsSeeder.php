<?php
// database/seeders/StoreProductsSeeder.php


namespace Database\Seeders;

use App\Models\StoreProduct;
use Illuminate\Database\Seeder;

class StoreProductsSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Grocery & Food
            ['name' => '11000 Can Beer', 'price' => 1580, 'category' => 'beverage', 'stock_quantity' => 11, 'rating' => 4.5, 'image_icon' => '🍺'],
            ['name' => '2X Spicy Noodles', 'price' => 3200, 'category' => 'grocery', 'stock_quantity' => 6, 'rating' => 4.8, 'image_icon' => '🍜'],
            ['name' => 'Atta', 'price' => 40, 'category' => 'grocery', 'stock_quantity' => 5, 'rating' => 4.0, 'image_icon' => '🌾'],
            ['name' => 'Butter', 'price' => 450, 'category' => 'grocery', 'stock_quantity' => 1, 'rating' => 4.3, 'image_icon' => '🧈'],
            ['name' => 'Cheese Slice', 'price' => 163, 'category' => 'grocery', 'stock_quantity' => 180, 'rating' => 4.6, 'image_icon' => '🧀'],
            ['name' => 'Dairy Milk Silk', 'price' => 100, 'category' => 'grocery', 'stock_quantity' => 18, 'rating' => 4.8, 'image_icon' => '🍫'],
            ['name' => 'Horlicks', 'price' => 264, 'category' => 'grocery', 'stock_quantity' => 14, 'rating' => 4.6, 'image_icon' => '🥛'],
            ['name' => 'Coke 1.5L', 'price' => 60, 'category' => 'beverage', 'stock_quantity' => 40, 'rating' => 4.7, 'image_icon' => '🥤'],
            ['name' => 'Fanta', 'price' => 60, 'category' => 'beverage', 'stock_quantity' => 12, 'rating' => 4.5, 'image_icon' => '🥤'],
            ['name' => 'Breezer', 'price' => 105, 'category' => 'beverage', 'stock_quantity' => 100, 'rating' => 4.6, 'image_icon' => '🥤'],
            
            // Beauty & Cosmetics
            ['name' => '16 Color Eyeshadow', 'price' => 190, 'category' => 'beauty', 'stock_quantity' => 10, 'rating' => 4.6, 'image_icon' => '💄'],
            ['name' => '4K Day Cream', 'price' => 375, 'category' => 'beauty', 'stock_quantity' => 4, 'rating' => 4.4, 'image_icon' => '🧴'],
            ['name' => 'Aloe Vera Body Lotion', 'price' => 95, 'category' => 'beauty', 'stock_quantity' => 48, 'rating' => 4.3, 'image_icon' => '🧴'],
            ['name' => 'Dove Shampoo', 'price' => 375, 'category' => 'beauty', 'stock_quantity' => 36, 'rating' => 4.7, 'image_icon' => '🧴'],
            ['name' => 'Colgate Herbal', 'price' => 105, 'category' => 'beauty', 'stock_quantity' => 60, 'rating' => 4.6, 'image_icon' => '🪥'],
            ['name' => 'Dettol Soap', 'price' => 40, 'category' => 'beauty', 'stock_quantity' => 80, 'rating' => 4.8, 'image_icon' => '🧼'],
            ['name' => 'Facial Wipes', 'price' => 100, 'category' => 'beauty', 'stock_quantity' => 100, 'rating' => 4.5, 'image_icon' => '🧻'],
            ['name' => 'Hair Treatment', 'price' => 520, 'category' => 'beauty', 'stock_quantity' => 20, 'rating' => 4.5, 'image_icon' => '💇'],
            
            // Household
            ['name' => 'Harpic Blue', 'price' => 105, 'category' => 'household', 'stock_quantity' => 69, 'rating' => 4.7, 'image_icon' => '🚽'],
            ['name' => 'Henko Surf', 'price' => 215, 'category' => 'household', 'stock_quantity' => 72, 'rating' => 4.6, 'image_icon' => '🧼'],
            ['name' => 'Dish Washing Thai', 'price' => 95, 'category' => 'household', 'stock_quantity' => 80, 'rating' => 4.4, 'image_icon' => '🧼'],
            ['name' => 'Garbage Bag Large', 'price' => 100, 'category' => 'household', 'stock_quantity' => 20, 'rating' => 4.5, 'image_icon' => '🗑️'],
            ['name' => 'Cellotape Big', 'price' => 250, 'category' => 'household', 'stock_quantity' => 15, 'rating' => 4.5, 'image_icon' => '📦'],
            ['name' => 'Anchor Bulbs', 'price' => 90, 'category' => 'household', 'stock_quantity' => 80, 'rating' => 4.5, 'image_icon' => '💡'],
            
            // Stationery
            ['name' => 'Cello Pen', 'price' => 20, 'category' => 'stationery', 'stock_quantity' => 170, 'rating' => 4.5, 'image_icon' => '✒️'],
            ['name' => 'Pencil Box', 'price' => 119, 'category' => 'stationery', 'stock_quantity' => 48, 'rating' => 4.4, 'image_icon' => '📦'],
            ['name' => 'Notebook', 'price' => 90, 'category' => 'stationery', 'stock_quantity' => 55, 'rating' => 4.3, 'image_icon' => '📓'],
            ['name' => 'Geometry Set', 'price' => 360, 'category' => 'stationery', 'stock_quantity' => 24, 'rating' => 4.6, 'image_icon' => '📐'],
            ['name' => 'Marker Pen', 'price' => 25, 'category' => 'stationery', 'stock_quantity' => 30, 'rating' => 4.4, 'image_icon' => '✒️'],
        ];
        
        foreach ($products as $product) {
            StoreProduct::create($product);
        }
    }
}