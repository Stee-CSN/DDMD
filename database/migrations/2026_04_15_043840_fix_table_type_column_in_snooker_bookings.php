<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Check if table_type column exists and modify it
        if (Schema::hasTable('snooker_bookings')) {
            Schema::table('snooker_bookings', function (Blueprint $table) {
                // Modify table_type column to be longer
                $table->string('table_type', 100)->nullable()->change();
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('snooker_bookings')) {
            Schema::table('snooker_bookings', function (Blueprint $table) {
                $table->string('table_type', 255)->change();
            });
        }
    }
};