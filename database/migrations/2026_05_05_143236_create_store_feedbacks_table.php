<?php
// database/migrations/2024_01_01_000003_create_store_feedbacks_table.php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreFeedbacksTable extends Migration
{
    public function up()
    {
        Schema::create('store_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('rating')->default(5);
            $table->text('feedback');
            $table->boolean('is_approved')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('store_feedbacks');
    }
}