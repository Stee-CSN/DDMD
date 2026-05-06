<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Product basic info
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('category');
            $table->string('sku')->unique()->nullable(); // Add SKU for product identification

            // Price & stock
            $table->decimal('price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable(); // Optional sale price
            $table->integer('stock')->default(0);
            $table->integer('low_stock_threshold')->default(5); // Alert when stock low

            // Image (store file path)
            $table->string('image')->nullable();
            $table->json('gallery')->nullable(); // Multiple images support

            // Status (active/inactive product)
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false); // Featured products
            
            // SEO & Meta
            $table->string('slug')->unique(); // URL-friendly name
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            // Timestamps & Soft Deletes
            $table->timestamps();
            $table->softDeletes(); // Allow soft deletion
            
            // Indexes for better performance
            $table->index('category');
            $table->index('is_active');
            $table->index('is_featured');
            $table->index('price');
            $table->index('created_at');
            $table->index(['category', 'is_active']); // Composite index
            $table->index(['is_active', 'is_featured']); // Composite index for featured active products
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};