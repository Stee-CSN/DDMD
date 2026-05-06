<?php
// database/migrations/2024_01_01_000002_create_store_orders_table.php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('store_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->json('items');
            $table->decimal('total_amount', 10, 2);
            $table->string('delivery_dzongkhag');
            $table->text('delivery_address');
            $table->enum('status', ['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');
            $table->timestamp('order_time');
            $table->timestamp('cancellation_deadline')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('store_orders');
    }
}