<?php
// database/migrations/2024_01_01_000002_create_restaurant_reservations_table.php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('restaurant_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->integer('number_of_guests');
            $table->date('reservation_date');
            $table->time('reservation_time');
            $table->text('special_requests')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('restaurant_reservations');
    }
}