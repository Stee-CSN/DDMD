<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('snooker_bookings', function (Blueprint $table) {
            // Change table_type column to be longer
            $table->string('table_type', 100)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('snooker_bookings', function (Blueprint $table) {
            $table->string('table_type', 255)->change();
        });
    }
};